<?php

namespace app\controllers;

use Yii;
use app\models\Quotation;
use app\models\search\QuotationSearch;
use yii\web\Controller;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\db\StaleObjectException;
use rmrevin\yii\fontawesome\FAS;

/**
 * QuotationController implements the CRUD actions for Quotation model.
 */
class QuotationController extends Controller
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
    * Lists all Quotation models.
    * @return mixed
    */
    public function actionIndex() {
        $searchModel = new QuotationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Quotation model.
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
    * Creates a new Quotation model.
    * If creation is successful, the browser will be redirected to the 'index' page.
    * @return mixed
    */
    public function actionCreate(){
        $model = new Quotation();
        if($model->load(Yii::$app->request->post()) && $model->save()){

            Yii::$app->session->setFlash('success',
                FAS::icon(FAS::_THUMBS_UP) .  "
                Quotation successfully created. ". Html::a('Click Here If you want to see the detail', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
            );
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
    * Updates an existing Quotation model.
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
                Quotation successfully updated. ". Html::a('Click Here If you want to see the detail', ['view', 'id' => $model->id], [ 'class' => 'btn btn-link'])
            );
            return $this->redirect(['index', 'page' => $page]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
    * Deletes an existing Quotation model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    * @throws StaleObjectException
    * @throws \Throwable
    */
    public function actionDelete($id, $page = null){
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', FAS::icon(FAS::_SAD_CRY) . " Quotation successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
    }

    /**
    * Finds the Quotation model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Quotation the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id){
        if (($model = Quotation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
