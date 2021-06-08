<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
/* @var $modelsDetail app\models\QuotationJob */
/* @var $modelsDetailDetail app\models\QuotationJobDetail */
/* @var $form kartik\form\ActiveForm */
?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?php echo $form->field($model, 'card_pic_and_address_id')->textInput(); ?>
	<?php echo $form->field($model, 'goods_type_id')->textInput(); ?>
	<?php echo $form->field($model, 'issue_date')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]); ?>
	<?php echo $form->field($model, 'reference_number')->textInput(['maxlength' => true]); ?>
	<?php echo $form->field($model, 'status')->dropDownList([ 'Draft' => 'Draft', 'Deal' => 'Deal', ], ['prompt' => '']); ?>
	<?php echo $form->field($model, 'remarks')->textarea(['rows' => 6]); ?>
	<?php echo $form->field($model, 'validity')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]); ?>
	<?php echo $form->field($model, 'log')->textInput(); ?>
	
    <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 100, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsDetail[0],
            'formId' => 'dynamic-form',
            'formFields' => [ 'id',  'quotation_id',  'name', ],
    ]); ?>
    <hr />
    <h5>Quotation job </h5>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titles</th>
                <th scope="col" style="width: 2px">Actions</th>
            </tr>
        </thead>

        <tbody class="container-items">

        <?php foreach ($modelsDetail as $i => $modelDetail): ?>
            <tr class="item">
                <td style="width: 2px;">

                    <?php if (!$modelDetail->isNewRecord) {
                        echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                    }  ?>

                    <i class="fa fa-adjust"></i>
                </td>

                <td>
                    <?php echo $form->field($modelDetail, "[{$i}]name"); ?>
                    <hr />
                    <?php echo  $this->render('_form-detail-detail', [
                        'form' => $form,
                        'i' => $i,
                        'modelsDetailDetail' => $modelsDetailDetail[$i],
                    ]) ?>
                </td>

                <td>
                    <button type="button" class="remove-item btn btn-danger  "><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3">
                    <?php echo Html::button('<span class="fa fa-plus"></span> Add quotation job', [
                            'class' => 'add-item btn btn-success  float-right',
                    ]); ?>

                    <div class="clearfix"></div>
                </td>
            </tr>
        </tfoot>
    </table>

    <?php DynamicFormWidget::end(); ?> 
    <?php ActiveForm::end();  ?> 
</div>
