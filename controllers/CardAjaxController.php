<?php

namespace app\controllers;

use Yii;
use app\models\Card;
use app\models\search\CardSearch;
use Throwable;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;

/**
 * CardAjaxController implements the CRUD actions for Card model.
 */
class CardAjaxController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\AjaxFilter',
                'except' => ['index'],
                // 'only' => ['create','update','view','delete',],
                // 'errorMessage' => "Metode tidak boleh diakses langsung, \n Timeout saat memanggil metode, \n Koneksi Internet Terputus / Lambat"
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Card models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CardSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Card model.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title'=> "Card #".$id,
            'content'=>$this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer'=> Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                    Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
        ];

    }

    /**
     * Creates a new Card model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws HttpException
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Card();

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($request->isGet){
            return [
                'title'=> "Create New Card",
                'content'=>$this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer'=>
                    Html::button('Close',[
                        'class'=>'btn btn-secondary mr-auto',
                        'data-dismiss'=>"modal"]) .
                    Html::button('Save',[
                        'class'=>'btn btn-primary ',
                        'type'=>"submit"
                    ])
            ];

        }else if($model->load($request->post()) && $model->save()){

            return [
                'forceReload'=>'#crud-datatable-pjax',
                'title'=> '<span class="text-success">Create New Card is Success</span>',
                'content'=> $this->renderAjax('view', [
                    'model' => $this->findModel($model->id),
                ]),
                'footer'=>
                    Html::button('Close',[
                        'class'=>'btn btn-secondary mr-auto',
                        'data-dismiss'=>"modal"
                    ]).
                    Html::a('Create More',['create'],[
                        'class'=>'btn btn-primary',
                        'role'=>'modal-remote'
                    ])
            ];

        }else{
            return [
                'title'=> '<span class="text-danger">Create New Card is Failed</span>',
                'content'=>$this->renderAjax('create', [
                    'model' => $model,
                ]),
                'footer'=>
                    Html::button('Close',[
                        'class'=>'btn btn-secondary mr-auto',
                        'data-dismiss'=>"modal"
                    ]).
                    Html::button('Save',[
                        'class'=>'btn btn-primary',
                        'type'=>"submit"
                    ])
            ];
        }
    }

    /**
     * Updates an existing Card model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id){
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($request->isGet){
            return [
                'title'=> "Update Card #".$id,
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                ]),
                'footer'=> Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                            Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
            ];
        }else if($model->load($request->post()) && $model->save()){
            return [
                'forceReload'=>'#crud-datatable-pjax',
                'title'=> '<span class="text-success">Update Card is Success</span>' . ' # '.$id,
                'content'=>
                    $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                'footer'=>
                    Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                    Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        }else{
             return [
                'title'=> '<span class="text-danger">Update Card is Failed</span>' . ' # '.$id,
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                ]),
                'footer'=>
                    Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
            ];
        }
    }

    /**
     * Delete an existing Card model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'forceClose'=>true,
            'forceReload'=>'#crud-datatable-pjax'
        ];
    }

     /**
     * Delete multiple existing Card model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;

        // Array or selected records primary keys
        $pks = explode(',', $request->post( 'pks' ));

        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'forceClose'=>true,
            'forceReload'=>'#crud-datatable-pjax'
        ];
    }

    /**
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
