<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\db\ActiveRecordInterface;


/* @var $this yii\web\View */
/* @var $generator \app\generators\dzilajaxcrud\generators\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}


/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
<?php endif; ?>
<?php if (!empty($generator->modelsClassDetail)): ?>
<?php $modelsDetail = StringHelper::basename($generator->modelsClassDetail); ?>
use <?= ltrim($generator->modelsClassDetail, '\\') ?>;
<?php endif; ?>
use app\models\Tabular;

use Throwable;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
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
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex(){
   <?php if (!empty($generator->searchModelClass)): ?>
    $searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       return $this->render('index', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
       ]);
   <?php else: ?>
    $dataProvider = new ActiveDataProvider([
        'query' => <?= $modelClass ?>::find(),
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
   <?php endif; ?>
    }


    /**
     * Displays a single <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws HttpException
     */
    public function actionView(<?= $actionParams ?>){

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'title'=> "<?= $modelClass ?> #".<?= $actionParams ?>,
            'content'=>$this->renderAjax('view', [
                'model' => $this->findModel(<?= $actionParams ?>),
            ]),
            'footer'=>
                Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                Html::a('Edit',['update','<?= substr($actionParams,1) ?>'=><?= $actionParams ?>],['class'=>'btn btn-primary','role'=>'modal-remote'])
        ];

    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * Only for ajax request will return json object
     * @return mixed
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate(){

        $request = Yii::$app->request;
        $model = new <?= $modelClass ?>();
        $modelsDetail = [ new <?= $modelsDetail ?>() ];

        # ONLY FOR AJAX REQUEST, BEHAVIOURS PREVENTING TO DIRECT ROUTE
        Yii::$app->response->format = Response::FORMAT_JSON;

        if($model->load($request->post())){

            $modelsDetail = Tabular::createMultiple(<?= $modelsDetail ?>::class);
            Tabular::loadMultiple($modelsDetail, $request->post());

            //validate models
            $isValid = $model->validate();
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid;

            if($isValid){
                $transaction = <?= $modelClass ?>::getDb()->beginTransaction();
                try{

                    if ($flag = $model->save(false)) {
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {break;}
                            $detail-><?= Inflector::underscore(StringHelper::basename($generator->modelClass)). '_id' ?> = $model->id;
                            if (!($flag = $detail->save(false))) {break;}
                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = ['code' => 1,'message' => 'Commit'];
                    } else {
                        $transaction->rollBack();
                        $status = ['code' => 0,'message' => 'Roll Back'];
                    }

                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = ['code' => 0,'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if($status['code']){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> '<span class="text-success">Create New <?= $modelClass ?> is Success</span>',
                        'content'=> $this->renderAjax('view', [
                            'model' => $this->findModel($model->id),
                        ]),
                        'footer'=>
                            Html::button('Close',[ 'class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                            Html::a('Create More',['create'],[ 'class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];

                }
            }
        }

        return [
            'title'=> "Create New <?= $modelClass ?>",
            'content'=>
                $this->renderAjax('create', [
                    'model' => $model,
                    'modelsDetail' => empty($modelsDetail) ? [ new <?= $modelsDetail ?>() ] : $modelsDetail,
                ]),
            'footer'=>
                Html::button('Close',[ 'class'=>'btn btn-secondary mr-auto', 'data-dismiss'=>"modal"]) .
                Html::button('Save', [ 'class'=>'btn btn-primary ', 'type'=>"submit"])
        ];

    }

    /**
     * Updates an existing <?= $modelClass ?> model.
     * Only For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate(<?= $actionParams ?>){

        $request = Yii::$app->request;
        $model = $this->findModel(<?= $actionParams ?>);
        $modelsDetail = !empty($model-><?= $details = lcfirst(Inflector::camelize(Inflector::pluralize(StringHelper::basename($modelsDetail)))) ?>) ? $model-><?= $details ?> : [new <?= $modelsDetail ?>()];

        Yii::$app->response->format = Response::FORMAT_JSON;

        if($model->load($request->post())){

            $oldDetailsID = ArrayHelper::map($modelsDetail, 'id', 'id'); # GET ALL ID

            $modelsDetail = Tabular::createMultiple(<?= $modelsDetail ?>::class, $modelsDetail); # Re-create models, Return as array.
            Tabular::loadMultiple($modelsDetail, $request->post()); # Load Post Request into it.
            $deletedDetailsID = array_diff($oldDetailsID,array_filter( ArrayHelper::map($modelsDetail, 'id', 'id'))); # Search ID that will be deleted

            $isValid = $model->validate(); # validate model 1
            $isValid = Tabular::validateMultiple($modelsDetail) && $isValid; # validate multiple model
            if($isValid){
                $transaction = <?= $modelClass ?>::getDb()->beginTransaction();
                try{
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedDetailsID)) {
                            <?= $modelsDetail ?>::deleteAll(['id' => $deletedDetailsID]);
                        }
                        foreach ($modelsDetail as $i => $detail) :
                            if ($flag === false) {
                                break;
                            }
                            $detail-><?= Inflector::underscore(StringHelper::basename($generator->modelClass)). '_id' ?> = $model->id;
                            if (!($flag = $detail->save(false))) {
                                break;
                            }
                        endforeach;
                    }

                    if ($flag) {
                        $transaction->commit();
                        $status = ['code' => 1, 'message' => 'Commit'];
                    } else {
                        $transaction->rollBack();
                        $status = ['code' => 0,'message' => 'Roll Back'];
                    }
                }catch (\Exception $e){
                    $transaction->rollBack();
                    $status = ['code' => 0,'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if($status['code']){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> '<span class="text-success">Update <?= $modelClass ?> is Success</span>' . ' # ' .  $status['message'] . ' # '.<?= $actionParams ?> ,
                        'content'=>
                            $this->renderAjax('view', [
                                'model' => $this->findModel(<?= $actionParams ?>),
                            ]),
                        'footer'=>
                            Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','<?= substr($actionParams,1) ?>'=><?= $actionParams ?>],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }
            }
        }

        return [
            'title'=> "Update <?= $modelClass ?> #".<?= $actionParams ?> ,
            'content'=> $this->renderAjax('update', [
                'model' => $model,
                'modelsDetail' => $modelsDetail
            ]),
            'footer'=>
                Html::button('Close',['class'=>'btn btn-secondary mr-auto','data-dismiss'=>"modal"]).
                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        ];
    }

    /**
     * Delete an existing <?= $modelClass ?> model.
     * Only For ajax request will return json object
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(<?= $actionParams ?>){

        $request = Yii::$app->request;
        $this->findModel(<?= $actionParams ?>)->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'forceClose'=>true,
            'forceReload'=>'#crud-datatable-pjax'
        ];
    }

     /**
     * Delete multiple existing <?= $modelClass ?> model.
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
     * Finds the <?= $modelClass ?> model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return <?=                   $modelClass ?> the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(<?= $actionParams ?>){
        <?php
            if (count($pks) === 1) {
                $condition = '$id';
            } else {
                $condition = [];
                foreach ($pks as $pk) {
                    $condition[] = "'$pk' => \$$pk";
                }
                $condition = '[' . implode(', ', $condition) . ']';
            }
        ?>
            if (($model = <?= $modelClass ?>::findOne(<?= $condition ?>)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
    }
}
