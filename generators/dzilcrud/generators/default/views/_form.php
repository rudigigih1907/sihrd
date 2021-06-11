<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form kartik\form\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <div class="card shadow">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
            <?php foreach ($generator->getColumnNames() as $attribute) {

            if (in_array($attribute, ['created_at', 'updated_at', 'created_by', 'updated_by'])) {
                continue;
            }

            if (in_array($attribute, $safeAttributes)) {
                echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n";
            }
            } ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= "<?= " ?>Html::a(FAS::icon(FAS::_WINDOW_CLOSE). <?= $generator->generateString(' Close') ?>, ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= "<?= " ?>Html::submitButton( FAS::icon(FAS::_SAVE). <?= $generator->generateString(' Save') ?>, ['class' =>'btn btn-primary' ]) ?>
            </div>
        </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

    </div>

</div>
