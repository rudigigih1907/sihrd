<?php

namespace app\controllers;

use app\models\form\ImportKehadiranMasukDiInternalSistemAbsensi;
use app\models\KehadiranDiInternalSistem;
use app\models\search\KehadiranDiInternalSistemSearch;
use rmrevin\yii\fontawesome\FAS;
use Yii;
use yii\base\Model;
use yii\bootstrap4\ActiveForm;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
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
     * @return string|\yii\web\Response
     */
    public function actionImportKehadiranMasuk() {

        $request = Yii::$app->request;
        $model = new ImportKehadiranMasukDiInternalSistemAbsensi();

        if ($model->load($request->post()) && $model->validate()) {
            return $this->redirect(['kehadiran-di-internal-sistem/preview-import-kehadiran-masuk', 'tanggal' => $model->tanggalMasuk]);
        }

        return $this->render('_form_import_kehadiran_masuk', [
            'model' => $model
        ]);
    }


    /**
     *
     * Import data kehadiran Karyawan.
     * @param $tanggal
     * @return array|string|Response
     * @throws \Throwable
     * @throws yii\base\InvalidConfigException
     * @throws yii\db\Exception
     */
    public function actionPreviewImportKehadiranMasuk($tanggal) {

        $absenRecords = KehadiranDiInternalSistem::findUntukImportKehadiranMasuk($tanggal);
        $request = Yii::$app->request;

        $models = [];
        if ($request->isGet) {

            foreach ($absenRecords as $key => $absenRecord) {
                $models[$key] = new KehadiranDiInternalSistem([
                    'jadwal_kerja_id' => $absenRecord['jadwal_kerja_id'],
                    'jadwal_kerja_hari_id' => $absenRecord['jadwal_kerja_hari_id'],
                    'jam_kerja_id' => $absenRecord['jam_kerja_id'],
                    'ketentuan_masuk' => $absenRecord['unformated_ketentuan_masuk'],
                    'ketentuan_pulang' => $absenRecord['unformated_ketentuan_pulang'],
                    'karyawan_id' => $absenRecord['karyawan_id'],
                    'aktual_masuk' => $absenRecord['aktual_masuk'],
                    'readonlyJadwalKerja' => $absenRecord['kode_jadwal_kerja'],
                    'readonlyJadwalKerjaHari' => $absenRecord['nama_hari_kerja'],
                    'readonlyJamKerja' => $absenRecord['kode_jam_kerja'],
                    'readonlyKetentuanMasuk' => $absenRecord['ketentuan_masuk'],
                    'readonlyKetentuanPulang' => $absenRecord['ketentuan_pulang'],
                    'readonlyKaryawan' => $absenRecord['nama_karyawan'],

                ]);
            }
        } else {

            $data = Yii::$app->request->post('KehadiranDiInternalSistem', []);
            foreach (array_keys($data) as $index) {
                $models[$index] = new KehadiranDiInternalSistem([]);
            }
            Model::loadMultiple($models, Yii::$app->request->post());

        }

        if ($request->isPost && $request->post('ajax') !== null) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validateMultiple($models);
        }

        if (Model::loadMultiple($models, $request->post())) {

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
                        'jam_kerja_id' => $el['jam_kerja_id'],
                        'ketentuan_masuk' => $el['ketentuan_masuk'],
                        'ketentuan_pulang' => $el['ketentuan_pulang'],
                        'karyawan_id' => $el['karyawan_id'],
                        'aktual_masuk' => !empty($el['aktual_masuk']) ?
                            Yii::$app->formatter->asDatetime($el['aktual_masuk'], "php:Y-m-d H:i")
                            : null,
                    ];
                }, ArrayHelper::toArray($models));

                // Lakukan transaksi di database;
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();
                try {
                    $db->createCommand()->batchInsert(KehadiranDiInternalSistem::tableName(),
                        ['jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id', 'ketentuan_masuk', 'ketentuan_pulang', 'karyawan_id', 'aktual_masuk'],
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
                    count($modelsArray) . ' record berhasil masuk ke Sistem Internal Absensi'
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
        ]);
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
