<?php

namespace app\controllers;

use app\models\Absensi;
use app\models\form\ImportDataDariMesinAbsensiMenggunakanExcelFile;
use app\models\search\AbsensiSearch;
use PhpOffice\PhpSpreadsheet\Exception;
use rmrevin\yii\fontawesome\FAS;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * AbsensiController implements the CRUD actions for Absensi model.
 */
class AbsensiController extends Controller {
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
     * Lists all Absensi models.
     * @param null $page
     * @return mixed
     */
    public function actionIndex($page = null) {
        $searchModel = new AbsensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Absensi model.
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
     * Creates a new Absensi model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Absensi();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) . "Absensi : " . $model->nama . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Absensi model.
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
                Absensi : " . $model->nama . " berhasil di update. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index', 'page' => $page]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Absensi model.
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

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Absensi : " . $oldLabel . " successfully deleted.");
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

                    return $this->render('preview-import-data-dari-mesin-absensi-menggunakan-excel-file', [
                        'sheets' => $model->parsingFile(),
                        'model' => $model,
                    ]);
                }

                Yii::$app->session->setFlash("error", "File gagal upload...!");

            }
        }

        return $this->render("import-data-dari-mesin-absensi-menggunakan-excel-file", [
            'model' => $model
        ]);
    }


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

        return $this->redirect(['absensi/index']);
    }

    /**
     * Finds the Absensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Absensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Absensi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
