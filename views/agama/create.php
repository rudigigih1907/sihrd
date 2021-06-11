<?php
/* @var $this yii\web\View */
/* @var $model app\models\Agama */
use yii\helpers\Html;

$this->title = 'Create Agama';
$this->params['breadcrumbs'][] = ['label' => 'Agamas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="agama-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
