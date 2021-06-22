<?php

namespace app\controllers;

use app\models\Libur;
use app\models\search\LiburSearch;
use rmrevin\yii\fontawesome\FAS;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LiburController implements the CRUD actions for Libur model.
 */
class LiburController extends Controller {
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
     * Lists all Libur models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LiburSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libur model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new Libur model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws InvalidConfigException
     */
    public function actionCreate() {
        $model = new Libur();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) . "
                Libur : " . Yii::$app->formatter->asDate($model->tanggal) . " berhasil ditambahkan. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Libur model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * @param integer $id
     * @param null $page
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws InvalidConfigException
     */
    public function actionUpdate($id, $page = null) {

        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info',
                FAS::icon(FAS::_THUMBS_UP) . "
                Libur : " . Yii::$app->formatter->asDate($model->tanggal) . " berhasil di update. " . Html::a('Klik link berikut jika ingin melihat detailnya', ['view', 'id' => $model->id], ['class' => 'btn btn-link'])
            );
            return $this->redirect(['index', 'page' => $page]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libur model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete($id, $page = null) {
        $model = $this->findModel($id);
        $oldLabel = $model->tanggal;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " Libur : " . $oldLabel . " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
     * Finds the Libur model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Libur the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Libur::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
