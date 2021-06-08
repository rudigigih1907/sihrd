<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $i int|string */
/* @var $model app\models\Quotation */
/* @var $modelsDetail app\models\QuotationJob */
/* @var $modelsDetailDetail app\models\QuotationJobDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetailDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [ 'id',  'quotation_job_id',  'name',  'unit_of_measurement_id',  'currency_id',  'value',  'unit_of_measurement_id_2', ],
]); ?>

<div class="card card-primary card-outline">
    <div class="card-header">
        <span class="card-title">Quotation job detail</span>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-bordered">

    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titles</th>
            <th scope="col" style="width: 2px">Actions</th>
        </tr>
    </thead>
    <tbody class="container-rooms">
        <?php foreach ($modelsDetailDetail as $j => $modelDetailDetail): ?>
        <tr class="room-item">
            <td style="width: 2px;">

                <?php if (!$modelDetailDetail->isNewRecord) {
                echo Html::activeHiddenInput($modelDetailDetail, "[{$i}][{$j}]id");
                }  ?>

                <i class="fa fa-list-ul"></i>
            </td>

            <td>
                                     <?php echo $form->field($modelDetailDetail, "[{$i}][{$j}]name"); ?>
                                     <?php echo $form->field($modelDetailDetail, "[{$i}][{$j}]unit_of_measurement_id"); ?>
                                     <?php echo $form->field($modelDetailDetail, "[{$i}][{$j}]currency_id"); ?>
                                     <?php echo $form->field($modelDetailDetail, "[{$i}][{$j}]value"); ?>
                                     <?php echo $form->field($modelDetailDetail, "[{$i}][{$j}]unit_of_measurement_id_2"); ?>
                            </td>
            <td class="text-center" style="width: 90px;">
                <button type="button" class="remove-room btn btn-danger btn-xs">
                    <span class="fa fa-trash-alt"></span>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3">
                <?php echo Html::button('<span class="fa fa-plus"></span> Add quotation job detail' , [
                'class' => 'add-room btn btn-success float-right',
                ]); ?>

                <div class="clearfix"></div>
            </td>
        </tr>
    </tfoot>

</table>
    </div>
    <!-- /.card-body -->
</div>
<?php  DynamicFormWidget::end(); ?>