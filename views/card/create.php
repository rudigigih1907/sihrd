<?php
/* @var $this yii\web\View */
/* @var $model app\models\Card */
use yii\helpers\Html;

$this->title = 'Create Card';
$this->params['breadcrumbs'][] = ['label' => 'Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="card-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
