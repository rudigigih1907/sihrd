<?php

namespace app\controllers;

use Yii;
use app\models\KehadiranDiInternalSistem;
use app\models\search\KehadiranDiInternalSistemSearch;
use yii\web\Controller;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\db\StaleObjectException;
use rmrevin\yii\fontawesome\FAS;

/**
 * KehadiranDiInternalSistemController implements the CRUD actions for KehadiranDiInternalSistem model.
 */
class KehadiranDiInternalSistemController extends Controller
{
    /**
    * {@inheritdoc}
    */
    public function behaviors()
        {
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
    public function actionDelete($id, $page = null){
        $model = $this->findModel($id);
        $oldLabel =  $model->id;

        $model->delete();

        Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " KehadiranDiInternalSistem : " . $oldLabel. " successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
    * Finds the KehadiranDiInternalSistem model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return KehadiranDiInternalSistem the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id){
        if (($model = KehadiranDiInternalSistem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
