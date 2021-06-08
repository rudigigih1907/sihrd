<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use kartik\grid\GridView;
use backend\generators\dzilajaxcrud\CrudAsset;
use backend\generators\dzilajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sessions');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="session-index">
    <div id="ajaxCrudDatatable">
        <?php try { 
            echo GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        Html::a(' <i class="fas fa-redo"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-secondary', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}'
                    ],
                ],
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'panelPrefix' => 'card card-',
                'panel' => [
                    'type'           => 'primary card-outline',
                    'headingOptions' => ['class'=>'card-header'],
                    'heading'        => '<i class="fas fa-list"></i>' . ' Sessions Listing',
                    'before'         => Html::a( ' <i class="fas fa-info-circle"></i> Last 24 Hour', ['session/view-online-today'], [
                                           'role'=>'modal-remote',
                                           'title'=> 'View Online Today',
                                           'class'=>'btn btn-primary'
                                        ]),
                    'after'         => BulkButtonWidget::widget([
                                            'buttons'=> Html::a( ' <i class="fas fa-trash-alt"></i>' . '&nbsp; Delete All', ["bulkdelete"] , [
                                                "class"=>"btn btn-danger btn-sm",
                                                'role'=>'modal-remote-bulk',
                                                'data-confirm'=>false,
                                                'data-method'=>false,// for override yii data api
                                                'data-request-method'=>'post',
                                                'data-confirm-title'=>'Are you sure?',
                                                'data-confirm-message'=>'Are you sure want to delete this item'
                                            ]),
                                       ]). '<div class="clearfix"></div>',
                ]
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
])?>
<?php Modal::end(); ?>
<?php $js =<<<JS
    jQuery(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
JS;
$this->registerJs($js) ?>