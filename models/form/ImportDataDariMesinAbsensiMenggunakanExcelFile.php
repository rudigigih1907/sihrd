<?php


namespace app\models\form;


use app\models\Karyawan;
use app\models\KehadiranDiMesinAbsensi;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\VarDumper;

class ImportDataDariMesinAbsensiMenggunakanExcelFile extends Model {

    public $attach_file;
    public $directoryToUpload = 'kehadiran-di-mesin-absensi';
    public $id; // file name
    public $allowedExtensions = 'csv,xls,xlsx';
    public $startColumn = "A";
    public $startRow = 1;

    /**
     * @return array
     */
    public function getColumnKey() {
        return [
            'A' => 'Tanggal scan',
            'B' => 'Tanggal',
            'C' => 'Jam',
            'D' => 'PIN',
            'E' => 'NIP',
            'F' => 'Nama',
            'G' => 'Jabatan',
            'H' => 'Departemen',
            'I' => 'Kantor',
            'J' => 'Verifikasi',
            'K' => 'IO',
            'L' => 'Workcode',
            'M' => 'SN',
            'N' => 'Mesin',
        ];
    }

    /**
     * @return array
     */
    public function getColumnKeyUnderscored() {
        return array_map(function ($element) {
            return str_replace(" ", "_", strtolower($element));
        }, $this->getColumnKey());
    }

    /**
     * @return string
     */
    public static function basePath() {
        return Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'uploads';
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'attach_file' => 'Attach File',
        ];
    }

    /**
     * @return array
     */
    public function rules() {
        return [
            [['attach_file'], 'file'],
            [['attach_file'], 'file', 'skipOnEmpty' => false, 'extensions' => $this->allowedExtensions],
            [['attach_file'], 'file', 'maxSize' => '8000000'],
            ['id', 'safe']
        ];
    }

    /**
     * Upload file to backend/uploads
     * @return bool
     */
    public function upload() {

        $basePath = self::basePath() . DIRECTORY_SEPARATOR . $this->directoryToUpload;

        if (!empty($this->attach_file)) {

            /* Check extension */
            if (!in_array($this->attach_file->extension, explode(",", $this->allowedExtensions))) {
                $this->addError('attach_file', $this->attach_file->extension);
                return false;
            }

            // Check folder is exist
            if (!file_exists($basePath)) {
                mkdir($basePath, 0755, true);
            }

            // Check apakah ada file sebelumnya dengan nama yang sama
            if (!empty($this->attach_file_name)) {
                $oldBaseFileName = $basePath . DIRECTORY_SEPARATOR . $this->attach_file_name;
                if (file_exists($oldBaseFileName)) {
                    unlink($oldBaseFileName);
                }
            }

            $baseFileName = $basePath . DIRECTORY_SEPARATOR .
                $this->attach_file->baseName . '.' .
                $this->attach_file->extension;

            $this->attach_file->saveAs($baseFileName);

            return true;

        }
        return false;
    }

    /**
     * @return Spreadsheet|string
     */
    protected function readFile($fileName = null) {
        try {

            $path = self::basePath()
                . DIRECTORY_SEPARATOR . $this->directoryToUpload
                . DIRECTORY_SEPARATOR;

            $path = is_null($fileName)
                ? $path . $this->attach_file->baseName . '.' . $this->attach_file->extension
                : $path . $fileName;

            $inputFileType = IOFactory::identify($path);
            $reader = IOFactory::createReader($inputFileType);
            return $reader->load($path);

        } catch (\Exception $e) {
            return $e->getTraceAsString();
        }
    }

    /**
     * @return array|string
     * @throws Exception
     */
    public function parsingFile() {

        $spreadsheet = $this->readFile();
        $sheetCount = $spreadsheet->getSheetCount();
        $sheetName = $spreadsheet->getSheetNames();

        $sheetData = [];
        for ($i = 0; $i < $sheetCount; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $cells = $sheet->rangeToArray(
                $this->startColumn . $this->startRow . ":" . $sheet->getHighestColumn() . $sheet->getHighestRow(),
                null,
                true,
                true,
                true
            );
            $sheetData[$sheetName[$i]] = $cells;
        }
        return $sheetData;
    }


    /**
     * @param $fileName
     * @param $startColumn
     * @param $startRow
     * @return array
     * @throws Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function insertKeDatabase($fileName, $startColumn, $startRow) {

        // 1. Load file
        $spreadsheet = $this->readFile($fileName);

        // Sheet tidak boleh lebih dari 1
        if ($spreadsheet->getSheetCount() > 1) {
            return [
                'status' => false,
                'message' => 'Sheet tidak boleh lebih dari 1'
            ];
        }

        $sheet = $spreadsheet->getSheet(0);
        $rows = $sheet->rangeToArray(
            $startColumn . $startRow . ":" . $sheet->getHighestColumn() . $sheet->getHighestRow(),
            null,
            true,
            true,
            true
        );

        if (empty($rows)) {
            return [
                'status' => false,
                'message' => 'File excel Anda Kosong'
            ];
        }

        $keys = self::getColumnKeyUnderscored();
        $keys['O'] = 'karyawan_id'; // TODO Hard Code
        $keys['P'] = 'file'; // TODO Hard Code
        $keys['Q'] = 'created_at'; // TODO Hard Code
        $keys['R'] = 'updated_at'; // TODO Hard Code
        $keys['S'] = 'created_by'; // TODO Hard Code
        $keys['T'] = 'updated_by'; // TODO Hard Code


        // Variable penampung
        $records = [];
        $apakahAdaKaryawanYangTidakAdaDiDatabase = false;
        $nomorNikBermasalah = null;

        $formatter = Yii::$app->formatter;
        foreach ($rows as $keyRow => $column) {

            // 2. Cek, apakah Karyawan ID ada, kalau ga ada, false;
            $karyawan = Karyawan::find()->where([
                'nomor_induk_karyawan' => trim($column['E'])
            ])->one();

            if (!$karyawan) {
                $apakahAdaKaryawanYangTidakAdaDiDatabase = true;
                $nomorNikBermasalah = $column['E'];
                break;
            }

            $records[$keyRow] = [
                'tanggal_scan' => $formatter->asDatetime($column['A'], 'php:Y-m-d H:i') ,
                'tanggal' =>$formatter->asDate($column['B'], 'php:Y-m-d'),
                'jam' => $formatter->asTime($column['C']),
                'pin' => $column['D'],
                'nip' => $column['E'],
                'nama' => $column['F'],
                'jabatan' => $column['G'],
                'departemen' => $column['H'],
                'kantor' => $column['I'],
                'verifikasi' => $column['J'],
                'io' => $column['K'],
                'workcode' => $column['L'],
                'sn' => $column['M'],
                'mesin' => $column['N'],
                'karyawan_id' => $karyawan->id,
                'file' => $fileName,
                'created_at' => time(),
                'updated_at' => time(),
                'created_by' => Yii::$app->user->id,
                'updated_by' => Yii::$app->user->id,
            ];
        }

        if ($apakahAdaKaryawanYangTidakAdaDiDatabase) {
            return [
                'status' => false,
                'message' => 'Ada Karyawan yang tidak ada di database yaitu dengan nomor NIK. '. $nomorNikBermasalah
            ];
        }

        // 3. Siapkan transaction
        $transaction = Yii::$app->db->beginTransaction();

        try {
            Yii::$app->db->createCommand()->batchInsert(
                KehadiranDiMesinAbsensi::tableName(), $keys, $records
            )->execute();

            $transaction->commit();
            $valid = [
                'status' => true,
                'message' => "Berhasil masuk ke database"
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            $valid = [
                'status' => false,
                'message' => $e->getFile() . ' ' .$e->getLine()
            ];
        }

        return $valid;

    }

}