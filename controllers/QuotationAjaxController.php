<?php

namespace app\controllers;

use Yii;
use app\models\Quotation;

use app\models\search\QuotationSearch;

use app\models\QuotationJob;

use app\models\QuotationJobDetail;

use app\models\Tabular;

use Throwable;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * QuotationAjaxController implements the CRUD actions for Quotation model.
 */
class QuotationAjaxController extends Controller
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
     * Lists all Quotation models.
     * @return mixed
     */
    public function actionIndex()
    {
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
     * @return mixed
     * @throws HttpException
     */
    public function actionView($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title'=> "Quotation #".$id,
            'content'=>$this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]),
            'footer'=> Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                    Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
        ];
    }

    /**
     * Creates a new Quotation model.
     * Only for ajax request will return json object
     * @return mixed
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Quotation();
        $modelsDetail = [ new QuotationJob() ];
        $modelsDetailDetail =[[new QuotationJobDetail()]];

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($request->isGet){
            return [
                'title'=> "Create New Quotation",
                'content'=>$this->renderAjax('create', [
                    'model' => $model,
                    'modelsDetail' => empty($modelsDetail) ? [ new QuotationJob() ] : $modelsDetail,
                    'modelsDetailDetail' => empty($modelsDetailDetail) ? [[new QuotationJobDetail()]] : $modelsDetailDetail,
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
        }else if($model->load($request->post())){

            $modelsDetail = Tabular::createMultiple(QuotationJob::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if (isset($_POST['QuotationJobDetail'][0][0])) {
                foreach ($_POST['QuotationJobDetail'] as $i => $quotationJobDetails) {
                    foreach ($quotationJobDetails as $j => $quotationJobDetail) {
                        $data['QuotationJobDetail'] = $quotationJobDetail;
                        $modelQuotationJobDetail = new QuotationJobDetail();
                        $modelQuotationJobDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelQuotationJobDetail;
                        $isValid = $modelQuotationJobDetail->validate() && $isValid;
                    }
                }
            }

            if($isValid){

                $transaction = Quotation::getDb()->beginTransaction();

                try{
                    $status = [];
                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :

                            if ($flag === false) {
                                break;
                            }

                            $detail->quotation_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->quotation_job_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> '<span class="text-success">Create New Quotation is Success</span>',
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
                }

                return [
                    'title'=> '<span class="text-warning">Create New Quotation is Failed</span>',
                    'content'=> $status['message'],
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
                    'title'=> '<span class="text-danger">Create New Quotation is Failed</span>',
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'modelsDetail' => empty($modelsDetail) ? [ new QuotationJob() ] : $modelsDetail,
                        'modelsDetailDetail' => empty($modelsDetailDetail) ? [[new QuotationJobDetail()]] : $modelsDetailDetail,
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
            }
        }
    }

    /**
     * Updates an existing Quotation model.
     * Only for ajax request will return json object
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate($id){
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $modelsDetail = !empty($model->quotationJobs) ?
            $model->quotationJobs :
            [new QuotationJob()];

        $modelsDetailDetail =[];
        $oldDetailDetails = [];

        if (!empty($modelsDetail)) {

            foreach ($modelsDetail as $i => $modelDetail) {
                $quotationJobDetails = $modelDetail->quotationJobDetails;
                $modelsDetailDetail[$i] = $quotationJobDetails;
                $oldDetailDetails = ArrayHelper::merge(ArrayHelper::index($quotationJobDetails, 'id'), $oldDetailDetails);
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($request->isGet){
            return [
                'title'=> "Update Quotation #".$id,
                'content'=>$this->renderAjax('update', [
                    'model' => $model,
                    'modelsDetail' => $modelsDetail,
                    'modelsDetailDetail' => $modelsDetailDetail,
                ]),
                'footer'=>
                    Html::button('Close',[
                        'class'=>'btn btn-secondary mr-auto',
                        'data-dismiss'=>"modal"
                    ]).
                    Html::button('Save',['
                        class'=>'btn btn-primary',
                        'type'=>"submit"
                    ])
            ];
        } else if($model->load($request->post())){

            // reset
            $modelsDetailDetail = [];

            // GET OLD IDs
            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id');

            $modelsDetail=Tabular::createMultiple(QuotationJob::class, $modelsDetail);
            Tabular::loadMultiple($modelsDetail, $request->post());

            $deletedDetailsID = array_diff($oldDetailsID,array_filter(
                    ArrayHelper::map($modelsDetail, 'id', 'id')
                )
            );

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;


            $detailDetailIDs = [];
            if (isset($_POST['QuotationJobDetail'][0][0])) {
                foreach ($_POST['QuotationJobDetail'] as $i => $quotationJobDetails) {

                    $detailDetailIDs = ArrayHelper::merge($detailDetailIDs, array_filter(ArrayHelper::getColumn($quotationJobDetails, 'id')));

                    foreach ($quotationJobDetails as $j => $quotationJobDetail) {
                        $data['QuotationJobDetail'] = $quotationJobDetail;

                        // Difference with actionCreate Here
                        $modelQuotationJobDetail =
                            (isset($quotationJobDetail['id']) && isset($oldDetailDetails[$quotationJobDetail['id']]))
                            ? $oldDetailDetails[$quotationJobDetail['id']]
                            : new QuotationJobDetail();

                        $modelQuotationJobDetail->load($data);
                        $modelsDetailDetail[$i][$j] = $modelQuotationJobDetail;
                        $isValid = $modelQuotationJobDetail->validate() && $isValid;
                    }
                }
            }


            $oldDetailDetailsIDs = ArrayHelper::getColumn($oldDetailDetails, 'id');
            $deletedDetailDetailsIDs = array_diff($oldDetailDetailsIDs, $detailDetailIDs);

            if($isValid){

                $transaction = Quotation::getDb()->beginTransaction();

                try{

                    if ($flag = $model->save(false)) {

                        if (!empty($deletedDetailDetailsIDs)) {
                            QuotationJobDetail::deleteAll(['id' => $deletedDetailDetailsIDs]);
                        }

                        if (!empty($deletedDetailsID)) {
                            QuotationJob::deleteAll(['id' => $deletedDetailsID]);
                        }



                        foreach ($modelsDetail as $i => $detail) :

                            if ($flag === false) {
                                break;
                            }

                            $detail->quotation_id = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }

                            if (isset($modelsDetailDetail[$i]) && is_array($modelsDetailDetail[$i])) {
                                foreach ($modelsDetailDetail[$i] as $j => $modelDetailDetail) {
                                    $modelDetailDetail->quotation_job_id = $detail->id;
                                    if (!($flag = $modelDetailDetail->save(false))) {
                                        break;
                                    }
                                }
                            }

                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = [
                            'code' => 1,
                            'message' => 'Commit'
                        ];
                    } else {
                        $transaction->rollBack();
                        $status = [
                            'code' => 0,
                            'message' => 'Roll Back'
                        ];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = [
                        'code' => 0,
                        'message' => 'Roll Back ' . $e->getMessage(),
                    ];
                }

                if($status['code']){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> '<span class="text-success">Update Quotation is Success</span>' . ' # ' .  $status['message'] . ' # '.$id ,
                        'content'=>  $this->renderAjax('view', [
                            'model' => $this->findModel($id),
                        ]),
                        'footer'=>
                            Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }

                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> '<span class="text-warning">Update Quotation is Failed</span>' . ' # ' .  $status['message'] . ' # '.$id ,
                    'content'=>  $this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=>
                        Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                        Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> '<span class="text-danger">Update Quotation is Failed</span>' . ' # '.$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'modelsDetail' => $modelsDetail,
                        'modelsDetailDetail' => $modelsDetailDetail,
                    ]),
                    'footer'=>
                        Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }
    }

    /**
     * Delete an existing Quotation model.
     * Only for ajax request will return json object
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
     * Delete multiple existing Quotation model.
     * Only for ajax request will return json object
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
