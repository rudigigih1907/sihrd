<?php
/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
use yii\helpers\Html;

$this->title = 'Create Quotation';
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="quotation-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
