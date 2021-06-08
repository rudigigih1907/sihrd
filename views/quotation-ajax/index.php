<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FAS;
use app\generators\dzilajaxcrud\CrudAsset;
use app\generators\dzilajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\QuotationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quotations';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="quotation-index">
    <div class="card shadow" id="ajaxCrudDatatable">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE).' Create Quotation', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote']) ?>
        </div>

        <?php try { 
            echo GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'responsive' => false,
                'responsiveWrap' => false,
                'bordered' => false,
                'toolbar'=> [
                    [
                        'content'=> null
                    ],
                ],
                'striped' => false,
            ]);
        }catch(Exception $e){
            echo $e->getMessage();
        }?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "size" => "modal-xl",
    "footer"=>"",// always need it for jquery plugin
    "options" => [
        "tabindex" => false // important for Select2 to work properly
    ],
    "clientOptions" => [
        "backdrop" => "static",
        "keyboard" => false
    ] 
])?>
<?php Modal::end(); ?>
<?php $js =<<<JS
    jQuery(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
JS;
$this->registerJs($js) ?>