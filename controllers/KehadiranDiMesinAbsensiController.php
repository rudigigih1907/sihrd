<?php

namespace app\controllers;

use app\models\KehadiranDiMesinAbsensi;
use app\models\form\ImportDataDariMesinAbsensiMenggunakanExcelFile;
use app\models\form\ReportExportDataUntukLaporanHarianAbsensi;
use app\models\search\KehadiranDiMesinAbsensiSearch;
use PhpOffice\PhpSpreadsheet\Exception;
use rmrevin\yii\fontawesome\FAS;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Expression;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * KehadiranDiMesinAbsensiController implements the CRUD actions for KehadiranDiMesinAbsensi model.
 */
class KehadiranDiMesinAbsensiController extends Controller {
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
     * Lists all KehadiranDiMesinAbsensi models.
     * @param null $page
     * @return mixed
     */
    public function actionIndex($page = null) {
        $searchModel = new KehadiranDiMesinAbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KehadiranDiMesinAbsensi model.
     * @param integer $id
     * @param null $page
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id, $page = null) {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new KehadiranDiMesinAbsensi model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new KehadiranDiMesinAbsensi();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) . "Kehadiran di Mesin Absensi : " . $model->nama . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing KehadiranDiMesinAbsensi model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $page = null) {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info',
                FAS::icon(FAS::_THUMBS_UP) . "
                Kehadiran di Mesin Absensi : " . $model->nama . " berhasil di update. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index', 'page' => $page]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing KehadiranDiMesinAbsensi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDelete($id, $page = null) {
        $model = $this->findModel($id);
        $oldLabel = $model->nama;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Kehadiran di Mesin Absensi : " . $oldLabel . " berhasil dihapus.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionImportDataDariMesinAbsensiMenggunakanExcelFile() {

        $request = Yii::$app->request;
        $model = new ImportDataDariMesinAbsensiMenggunakanExcelFile();
        if ($request->isPost) {

            $model->attach_file = UploadedFile::getInstance($model, 'attach_file');

            if ($model->attach_file && $model->validate()) {
                $model->startColumn = "A";
                $model->startRow = "3";
                if ($model->upload()) {

                    return $this->render('_preview_import_data_dari_mesin_absensi_menggunakan_excel_file', [
                        'sheets' => $model->parsingFile(),
                        'model' => $model,
                    ]);
                }

                Yii::$app->session->setFlash("error", "File gagal upload...!");

            }
        }

        return $this->render("_form_import_data_dari_mesin_absensi_menggunakan_excel_file", [
            'model' => $model
        ]);
    }

    /**
     * @param $file
     * @param $startColumn
     * @param $startRow
     * @return Response
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionImportDataDariMesinAbsensiMenggunakanExcelFileKeDatabase($file, $startColumn, $startRow) {

        $model = new ImportDataDariMesinAbsensiMenggunakanExcelFile();

        $batchInsert = $model->insertKeDatabase($file, $startColumn, $startRow);
        $session = Yii::$app->session;

        if ($batchInsert['status']) {
            $session->setFlash('success', FAS::icon(FAS::_THUMBS_UP) .
                " " . $batchInsert['message']);
        } else {
            $session->setFlash('error', FAS::icon(FAS::_THUMBS_DOWN) .
                " " . 'Gagal Insert ke database karena ' . $batchInsert['message']);
        }

        return $this->redirect(['kehadiran-di-mesin-absensi/index']);
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function actionBuatLaporanHarian() {

        $request = Yii::$app->request;
        $model = new ReportExportDataUntukLaporanHarianAbsensi();

        if ($model->load($request->post())) {

            $where = new Expression(" DATE(tanggal_scan) = :tanggal",[
                'tanggal' => Yii::$app->formatter->asDate($model->tanggal, 'php:Y-m-d')
            ]);

            $days = KehadiranDiMesinAbsensi::find()
                ->select([
                    'tanggal_scan',
                    'nik' => 'karyawan.nomor_induk_karyawan',
                    'nama' => 'karyawan.nama',
                    'tanggal',
                    'jam',
                    'nip' => 'karyawan.nomor_induk_karyawan'
                ])
                ->joinWith('karyawan', false)
                ->where($where)
                ->asArray()
                ->all();

            return $this->render('_preview_report_export_data_untuk_laporan_harian_absensi', [
                'days' => $days,
                'model' => $model
            ]);


        }

        return $this->render('_form_report_export_data_untuk_laporan_harian_absensi', [
            'model' => $model
        ]);


    }

    public function actionExportLaporanHarianKePDF($tanggal) {

    }

    /**
     * Finds the KehadiranDiMesinAbsensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KehadiranDiMesinAbsensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = KehadiranDiMesinAbsensi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
