<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \app\generators\dzilajaxcrud\generators\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $i int|string */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $modelsDetail <?= ltrim($generator->modelsClassDetail, '\\') ?> */
/* @var $modelsDetailDetail <?= ltrim($generator->modelsClassDetailDetail, '\\') ?> */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<?= "<?php " ?>
DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsDetailDetail[0],
    'formId' => 'dynamic-form',
    'formFields' => [<?php foreach ($generator->getDetailDetailColumnNames() as $columnName) {
                echo " '" . $columnName . "', " ;} ?>],
]); ?>

<h5><?= $detailDetail =   ucwords(Inflector::titleize(Inflector::pluralize(StringHelper::basename($generator->modelsClassDetailDetail)))) ?></h5>
<table class="table table-bordered">

    <thead class="thead-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Titles</th>
        <th scope="col" style="width: 2px">Act</th>
    </tr>
    </thead>
    <tbody class="container-rooms">
    <?= "<?php " ?>foreach ($modelsDetailDetail as $j => $modelDetailDetail): ?>
    <tr class="room-item">
        <td style="width: 2px;">

            <?= "<?php " ?>if (!$modelDetailDetail->isNewRecord) {
            echo Html::activeHiddenInput($modelDetailDetail, "[{$i}][{$j}]id");
            }  ?>

            <i class="fa fa-list-ul"></i>
        </td>

        <td>
            <?php foreach ($generator->getDetailDetailColumnNames() as $columnName) {
                if($columnName === 'id') continue;
                if($columnName ===  Inflector::underscore(StringHelper::basename($generator->modelsClassDetail)). '_id') continue;
                ?>
                <?= " <?php echo "?>$form->field($modelDetailDetail, "[{$i}][{$j}]<?= $columnName ?>"); ?>
            <?php } ?>
        </td>
        <td class="text-center" style="width: 90px;">
            <button type="button" class="remove-room btn btn-danger btn-sm">
                <span class="fa fa-trash-alt"></span>
            </button>
        </td>
    </tr>
    <?= "<?php " ?>endforeach; ?>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="3">
            <?= "<?php echo " ?>Html::button('<span class="fa fa-plus"></span> Add <?= lcfirst($detailDetail) ?>' , [
            'class' => 'add-room btn btn-success float-right',
            ]); ?>

            <div class="clearfix"></div>
        </td>
    </tr>
    </tfoot>

</table>
<?= "<?php " ?> DynamicFormWidget::end(); ?>