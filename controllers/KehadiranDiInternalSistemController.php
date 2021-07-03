<?php

namespace app\controllers;

use app\models\form\ImportKehadiranDiInternalSistemAbsensi;
use app\models\form\LaporanHarianAbsensi;
use app\models\KehadiranDiInternalSistem;
use app\models\search\KehadiranDiInternalSistemSearch;
use app\models\Tabular;
use rmrevin\yii\fontawesome\FAS;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * KehadiranDiInternalSistemController implements the CRUD actions for KehadiranDiInternalSistem model.
 */
class KehadiranDiInternalSistemController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'batch-update-jam-pulang-karyawan' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all KehadiranDiInternalSistem models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new KehadiranDiInternalSistemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single KehadiranDiInternalSistem model.
    * @param integer $id
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
    * Creates a new KehadiranDiInternalSistem model.
    * If creation is successful, the browser will be redirected to the 'index' page.
    * @return mixed
    */
    public function actionCreate(){
        $model = new KehadiranDiInternalSistem();
        if($model->load(Yii::$app->request->post()) && $model->save()){

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) .  "
                KehadiranDiInternalSistem : " . $model->id . " berhasil ditambahkan. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
            );
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
    * Updates an existing KehadiranDiInternalSistem model.
    * If update is successful, the browser will be redirected to the 'index' page with pagination URL
    * @param integer $id
    * @param null $page
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id, $page = null){

        $model = $this->findModel($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('info',
                FAS::icon(FAS::_THUMBS_UP) .  "
                KehadiranDiInternalSistem : " . $model->id . " berhasil di update. ". Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
            );
            return $this->redirect(['index', 'page' => $page]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KehadiranDiInternalSistem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete($id, $page = null) {
        $model = $this->findModel($id);
        $oldLabel = $model->id;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " KehadiranDiInternalSistem : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * Menampilkan Form Import data kehadiran
     * @return string|\yii\web\Response
     */
    public function actionImportKehadiranMasuk() {

        $request = Yii::$app->request;
        $model = new ImportKehadiranDiInternalSistemAbsensi();

        if ($model->load($request->post()) && $model->validate()) {
            return $this->redirect(['kehadiran-di-internal-sistem/preview-import-kehadiran-masuk',
                'tanggal' => Yii::$app->formatter->asDate($model->tanggal, 'php:Y-m-d')
            ]);
        }

        return $this->render('_form_import_kehadiran', [
            'model' => $model,
            'title' =>"Import Kehadiran Masuk"
        ]);
    }

    /**
     * Preview Import data kehadiran Karyawan masuk kantor.
     * @param $tanggal
     * @return array|string|Response
     * @throws \Throwable
     * @throws yii\base\InvalidConfigException
     * @throws yii\db\Exception
     */
    public function actionPreviewImportKehadiranMasuk($tanggal) {
        $request = Yii::$app->request;
        $models = [];

        if ($request->isGet) {
            $absenRecords = KehadiranDiInternalSistem::findUntukImportKehadiranMasuk($tanggal);
            foreach ($absenRecords as $key => $absenRecord) {
                $models[$key] = new KehadiranDiInternalSistem([
                    'jadwal_kerja_id' => $absenRecord['jadwal_kerja_id'],
                    'jadwal_kerja_hari_id' => $absenRecord['jadwal_kerja_hari_id'],
                    'jam_kerja_id' => $absenRecord['jam_kerja_id'],
                    'tanggal' => $absenRecord['tanggal'],
                    'ketentuan_masuk' => $absenRecord['unformated_ketentuan_masuk'],
                    'ketentuan_pulang' => $absenRecord['unformated_ketentuan_pulang'],
                    'karyawan_id' => $absenRecord['karyawan_id'],
                    'aktual_masuk' => $absenRecord['unformated_aktual_masuk'],
                    'readonlyJadwalKerja' => $absenRecord['kode_jadwal_kerja'],
                    'readonlyJadwalKerjaHari' => $absenRecord['nama_hari_kerja'],
                    'readonlyJamKerja' => $absenRecord['kode_jam_kerja'],
                    'readonlyKetentuanMasuk' => $absenRecord['ketentuan_masuk'],
                    'readonlyKetentuanPulang' => $absenRecord['ketentuan_pulang'],
                    'readonlyKaryawan' => $absenRecord['nama_karyawan'],
                    'readonlyAktualMasuk' => $absenRecord['aktual_masuk'],
                ]);
            }
        }

        if ($request->isPost) {

            $models = Tabular::createMultiple(KehadiranDiInternalSistem::class);
            Tabular::loadMultiple($models, $request->post());

            // Cari karyawan yang duplicate
            $countValues = array_count_values(
                array_column($request->post('KehadiranDiInternalSistem'), 'readonlyKaryawan')
            );

            $errorCounting = [];
            foreach ($countValues as $key => $countValue) :
                if ($countValue > 1) {
                    $errorCounting[$key] = $countValue;
                }
            endforeach;

            // Tidak ada yang duplicate, insert ke database
            if (empty($errorCounting)) {

                // Siapkan datanya.
                $modelsArray = array_map(function ($el) {
                    return [
                        'jadwal_kerja_id' => $el['jadwal_kerja_id'],
                        'jadwal_kerja_hari_id' => $el['jadwal_kerja_hari_id'],
                        'jam_kerja_id' => empty($el['jam_kerja_id']) ? NULL : $el['jam_kerja_id'],
                        'tanggal' => $el['tanggal'],
                        'ketentuan_masuk' => empty($el['ketentuan_masuk']) ? NULL : $el['ketentuan_masuk'],
                        'ketentuan_pulang' => empty($el['ketentuan_pulang']) ? NULL : $el['ketentuan_pulang'],
                        'karyawan_id' => $el['karyawan_id'],
                        'aktual_masuk' => !empty($el['aktual_masuk']) ? $el['aktual_masuk'] : null,
                    ];
                }, ArrayHelper::toArray($models));

                // Lakukan transaksi di database;
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();
                try {
                    $db->createCommand()->batchInsert(KehadiranDiInternalSistem::tableName(),
                        ['jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id', 'tanggal', 'ketentuan_masuk', 'ketentuan_pulang', 'karyawan_id', 'aktual_masuk'],
                        $modelsArray
                    )->execute();

                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw  $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }

                Yii::$app->session->setFlash('success',
                    FAS::icon(FAS::_THUMBS_UP) .
                    ' ' .count($modelsArray) . ' record berhasil masuk ke Sistem Internal Absensi'
                );

                return $this->redirect(['index']);
            }

            // Tampilkan error message, karena ada record yang duplikat
            Yii::$app->session->setFlash('error', "Ada Karyawan yang duplikat. " .
                Html::ul($errorCounting, ['item' => function ($item, $index) {
                    return Html::tag('li', $index . ', ' . $item . ' records', []);
                }
                ])
            );

        }

        return $this->render('_preview_import_kehadiran_masuk', [
            'models' => $models,
            'tanggal' => $tanggal
        ]);
    }

    /**
     * Tampilkan form untuk mencari data untuk di cancel
     * @return string
     */
    public function actionFormCancelKehadiran() {

        $request = Yii::$app->request;
        $model = new ImportKehadiranDiInternalSistemAbsensi();

        if ($model->load($request->post()) && $model->validate()) {

            $data = KehadiranDiInternalSistem::findUntukBatalkanData();

            return $this->render('_preview_cancel_kehadiran', [
                'tanggal' => $model->tanggal,
                'data' => $data
            ]);
        }

        return $this->render('_form_import_kehadiran', [
            'model' => $model,
            'title' => "Batalkan data per tanggal"
        ]);
    }

    /**
     * @param $tanggal
     * @return Response
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCancelKehadiran($tanggal) {
        KehadiranDiInternalSistem::deleteAll([
            'tanggal' => $tanggal
        ]);
        Yii::$app->session->setFlash('success', FAS::icon(FAS::_SAD_CRY)
            . " Kehadiran DiInternal Sistem : "
            . Yii::$app->formatter->asDate($tanggal)
            . " berhasil dihapus.");
        return $this->redirect(['index']);
    }

    /**
     * @return string|Response
     */
    public function actionImportKehadiranPulang() {

        $request = Yii::$app->request;
        $model = new ImportKehadiranDiInternalSistemAbsensi();

        if ($model->load($request->post()) && $model->validate()) {
            return $this->redirect(['kehadiran-di-internal-sistem/preview-import-kehadiran-pulang', 'tanggal' => $model->tanggal]);
        }

        return $this->render('_form_import_kehadiran', [
            'model' => $model,
            'title' => "Import Kehadiran Pulang"
        ]);
    }

    /**
     * Preview data sebelum meng-update data jam pulang karyawan.
     *
     * 1. Dari mesin absensi, export data terakhir pada tanggal tertentu. (DONE)
     * 2. Hasil file berupa excel kemudian di import masuk ke dalam table `kehadiran_di_mesin_absensi`.  (DONE)
     * 3. Tarik lagi data dari  `kehadiran_di_mesin_absensi` kemudian di previewkan
     *
     *
     *
     * @param $tanggal
     * @return array|string|Response
     * @throws \Throwable
     */
    public function actionPreviewImportKehadiranPulang($tanggal) {

        $models = KehadiranDiInternalSistem::findUntukImportKehadiranPulang($tanggal);
        return $this->render('_preview_import_kehadiran_pulang', [
            'models' => $models,
            'tanggal' => $tanggal
        ]);

    }

    /**
     * Batch update jam pulang karyawan
     * @param $tanggal
     * @return Response
     * @throws \Throwable
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function actionBatchUpdateJamPulangKaryawan($tanggal){

        $models = KehadiranDiInternalSistem::findUntukImportKehadiranPulang($tanggal);
        $connection = KehadiranDiInternalSistem::getDb();
        $transaction = $connection->beginTransaction();

        try {
            foreach ($models as $model) {
                $connection->createCommand()->update(KehadiranDiInternalSistem::tableName(),[
                    'aktual_masuk' => $model['aktual_masuk'],
                    'aktual_pulang' => $model['aktual_pulang'],
                ],[
                    'karyawan_id'=> $model['karyawan_id'],
                    'tanggal' => $model['tanggal_scan'],
                ])->execute();
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->redirect('index');
    }

    /**
     * Tampilkan form untuk membuat laporan harian
     * @return string
     * @throws yii\db\Exception
     * @throws yii\base\InvalidConfigException
     */
    public function actionCreateLaporanHarian() {

        $request = Yii::$app->request;
        $model = new LaporanHarianAbsensi();

        if($model->load($request->post())){
            $records = KehadiranDiInternalSistem::findUntukLaporanHarianHanyaJabatanUtamaSajaRawSql(
                Yii::$app->formatter->asDate($model->tanggal, 'php:Y-m-d')
            );
            return $this->render('_preview_laporan_harian', [
                'records' => $records,
                'model' => $model,
            ]);
        }

        return $this->render('_form_laporan_harian', [
            'model' => $model
        ]);

    }

    /**
     * Laporan Harian untuk kehadiran pagi
     * @param $tanggal
     * @return string
     * @throws HttpException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\db\Exception
     */
    public function actionExportLaporanHarianPagiDenganFormatPdf($tanggal){

        if ($records = KehadiranDiInternalSistem::findUntukLaporanHarianHanyaJabatanUtamaSajaRawSql($tanggal)) {

            try {
                $pdf = Yii::$app->pdfDenganMinimalMarginJugaHeaderDariAplikasi;
                $pdf->filename = 'Laporan Harian Absensi Pagi - ' . Yii::$app->formatter->asDate($tanggal) . '.pdf';
                $pdf->content = $this->renderPartial('_pdf_laporan_pagi', [
                    'records' => $records,
                    'tanggal' => $tanggal,
                ]);
                return $pdf->render();
            } catch (NotFoundHttpException $e) {
                return $e->getMessage();
            }
        }
        throw new HttpException(400, 'Model is not found');
    }

    public function actionExportLaporanHarianPerHariDenganFormatPdf($tanggal){

        if ($records = KehadiranDiInternalSistem::findUntukLaporanHarianHanyaJabatanUtamaSajaRawSql($tanggal)) {

            try {
                $pdf = Yii::$app->pdfDenganMinimalMarginJugaHeaderDariAplikasi;
                $pdf->filename = 'Laporan Harian Absensi Pagi - ' . Yii::$app->formatter->asDate($tanggal) . '.pdf';
                $pdf->content = $this->renderPartial('_pdf_laporan_per_hari', [
                    'records' => $records,
                    'tanggal' => $tanggal,
                ]);
                return $pdf->render();
            } catch (NotFoundHttpException $e) {
                return $e->getMessage();
            }
        }
        throw new HttpException(400, 'Model is not found');
    }

    /**
     * Finds the KehadiranDiInternalSistem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KehadiranDiInternalSistem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = KehadiranDiInternalSistem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
