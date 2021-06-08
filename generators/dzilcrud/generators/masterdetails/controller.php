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

use Exception;
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
use yii\helpers\Html;

use Throwable;
use yii\db\StaleObjectException;
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use rmrevin\yii\fontawesome\FAS;

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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
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

        return $this->render('view', [
            'model' => $this->findModel(<?= $actionParams ?>),
        ]);

    }

    /**
     * Creates a new <?= $modelClass ?> model.
     * @return mixed
     */
    public function actionCreate(){

        $request = Yii::$app->request;
        $model = new <?= $modelClass ?>();
        $modelsDetail = [ new <?= $modelsDetail ?>() ];

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

                }catch (Exception $e){
                    $transaction->rollBack();
                    $status = ['code' => 0,'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('success',
                        FAS::icon(FAS::_THUMBS_UP) .  "
                        <?= $modelClass ?> successfully created. ". Html::a('Click Here If you want to see the detail', ['view', <?= $urlParams ?>], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index']);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " <?= $modelClass ?> is failed to insert. Info: ". $status['message']);
            }
        }

        return $this->render( 'create', [
            'model' => $model,
            'modelsDetail' => empty($modelsDetail) ? [ new <?= $modelsDetail ?>() ] : $modelsDetail,
        ]);

    }

    /**
     * Updates an existing <?= $modelClass ?> model.
     * If update is successful, the browser will be redirected to the 'index' page with pagination URL
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @param null $page
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate(<?= $actionParams ?>, $page = null){

        $request = Yii::$app->request;
        $model = $this->findModel(<?= $actionParams ?>);
        $modelsDetail = !empty($model-><?= $details = lcfirst(Inflector::camelize(Inflector::pluralize(StringHelper::basename($modelsDetail)))) ?>) ? $model-><?= $details ?> : [new <?= $modelsDetail ?>()];

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
                }catch (Exception $e){
                    $transaction->rollBack();
                    $status = ['code' => 0,'message' => 'Roll Back ' . $e->getMessage(),];
                }

                if($status['code']){
                    Yii::$app->session->setFlash('info',
                            FAS::icon(FAS::_THUMBS_UP) .  "
                            <?= $modelClass ?> successfully updated. ". Html::a('Click Here If you want to see the detail', ['view', <?= $urlParams ?>], [ 'class' => 'btn btn-link'])
                    );
                    return $this->redirect(['index', 'page' => $page]);
                }

                Yii::$app->session->setFlash('danger', FAS::icon(FAS::_SAD_CRY) . " <?= $modelClass ?> is failed to updated. Info: ". $status['message']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsDetail' => $modelsDetail
        ]);
    }

    /**
     * Delete an existing <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(<?= $actionParams ?>, $page = null){

        $this->findModel(<?= $actionParams ?>)->delete();

        Yii::$app->session->setFlash('success', FAS::icon(FAS::_SAD_CRY) . " <?= $modelClass ?> successfully deleted.");
        return $this->redirect(['index', 'page' => $page]);
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
