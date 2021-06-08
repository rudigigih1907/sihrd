<?php
use yii\bootstrap4\Tabs;
use yii\widgets\DetailView;
use app\widgets\Table;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
?>
<div class="quotation-view">

                
    <?php  $third = [];
        foreach ($model->quotationJobs as $quotationJob){
            foreach ($quotationJob->quotationJobDetails as $quotationJobDetail){
                $third[] = $quotationJobDetail->attributes;
            }
        }
    ?>

<?php try { echo Tabs::widget([
                'encodeLabels' => false,
                'options' => [
                    'class' => 'nav nav-tabs'
                ],
                'tabContentOptions' => [
                    'style' => [
                        'padding-top' => '12px'
                    ]
                ],
                'items' => [
                    [
                        'active' => true,
                        'label' => FAS::icon(FAS::_YIN_YANG) . ' Quotation',
                        'content' =>
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'card_pic_and_address_id',
'goods_type_id',
'issue_date',
'reference_number',
'status',
'remarks:ntext',
           [
                                                    'attribute' => 'created_at',
                    'format' => 'datetime',            
           ],
           [
                                                    'attribute' => 'updated_at',
                    'format' => 'datetime',            
           ],
           [
                                                    'attribute' => 'created_by',
                    'value' => function($model){ return \app\models\User::findOne($model->created_by)->username; }            
           ],
           [
                                                    'attribute' => 'updated_by',
                    'value' => function($model){ return \app\models\User::findOne($model->updated_by)->username; }            
           ],
'validity',
'log',
                                ],
                            ]) ,

                        ],
                        [
                            'label' => 'Quotation Jobs',
                            'content' =>
                                Table::widget([
                                    'data' => $model->quotationJobs
,
                                    'skippedColumns' => [
                                        'quotation_id'
                                    ]
                                ])
                            ,
                        ],
                        [
                            'label' => 'Quotation Job Details',
                            'content' =>
                                Table::widget([
                                    'data' => $third,
                                    'skippedColumns' => [
                                        'quotationJob_id'
                                    ]
                                ])
                            ,
                        ],
                    ],
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    ?>
</div>