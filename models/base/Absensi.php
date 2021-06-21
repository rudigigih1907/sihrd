<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "absensi".
 *
 * @property integer $id
 * @property string $tanggal_scan
 * @property string $tanggal
 * @property string $jam
 * @property string $pin
 * @property string $nip
 * @property string $nama
 * @property string $jabatan
 * @property string $departemen
 * @property string $kantor
 * @property string $verifikasi
 * @property string $io
 * @property string $workcode
 * @property string $sn
 * @property string $mesin
 * @property integer $karyawan_id
 *
 * @property \app\models\Karyawan $karyawan
 * @property string $aliasModel
 */
abstract class Absensi extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'absensi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal_scan', 'tanggal', 'karyawan_id'], 'required'],
            [['tanggal_scan', 'tanggal', 'jam'], 'safe'],
            [['karyawan_id'], 'integer'],
            [['pin', 'nip', 'jabatan', 'departemen', 'kantor', 'verifikasi', 'io', 'workcode', 'sn', 'mesin'], 'string', 'max' => 50],
            [['nama'], 'string', 'max' => 255],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal_scan' => 'Tanggal Scan',
            'tanggal' => 'Tanggal',
            'jam' => 'Jam',
            'pin' => 'Pin',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'departemen' => 'Departemen',
            'kantor' => 'Kantor',
            'verifikasi' => 'Verifikasi',
            'io' => 'Io',
            'workcode' => 'Workcode',
            'sn' => 'Sn',
            'mesin' => 'Mesin',
            'karyawan_id' => 'Karyawan ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(\app\models\Karyawan::className(), ['id' => 'karyawan_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\AbsensiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\AbsensiQuery(get_called_class());
    }


}