<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $i int|string */
/* @var $model app\models\JadwalKerja */
/* @var $modelsDetail app\models\JadwalKerjaDetail */
/* @var $modelsDetailDetail app\models\JadwalKerjaDetailDetail */
/* @var $form yii\bootstrap4\ActiveForm */
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
    'formFields' => ['id', 'jadwal_kerja_detail_id', 'jam_kerja_id',],
]); ?>


    <table class="card-table table table-borderless">

        <thead class="thead-light">
        <tbody class="container-rooms container-items-horizontal border-bottom">
        <?php foreach ($modelsDetailDetail as $j => $modelDetailDetail): ?>
            <tr class="room-item">

                <td class="text-center" style="width: 90px;">
                    <button type="button" class="remove-room btn btn-outline-danger btn-sm">
                        <span class="fa fa-trash-alt"></span>
                    </button>
                </td>

                <td>
                    <?php if (!$modelDetailDetail->isNewRecord) {
                        echo Html::activeHiddenInput($modelDetailDetail, "[{$i}][{$j}]id");
                    } ?>
                    <?php echo $form->field($modelDetailDetail, "[{$i}][{$j}]jam_kerja_id", $template)
                        ->widget(\kartik\select2\Select2::class, [
                            'data' => \app\models\JamKerja::mapIDToNama(),
                            'options' => [
                                'placeholder' => 'Select ...',
                                'class' => 'clearable'
                            ],

                            'pluginOptions' => [
                                'allowClear' => true,
                                'dropdownAutoWidth' => true,
                            ]

                        ]); ?>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>

        <tfoot>
        <tr>

            <td></td>
            <td class="text-right">
                <?php echo Html::button('<span class="fa fa-plus-circle"></span>', [
                    'class' => 'add-room btn btn-sm btn-outline-success',
                ]); ?>

                <div class="clearfix"></div>
            </td>
        </tr>
        </tfoot>

    </table>
<?php DynamicFormWidget::end(); ?>