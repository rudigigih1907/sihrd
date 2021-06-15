<?php
/* @var $this yii\web\View */
/* @var $model app\models\Session */
use yii\helpers\Html;

$this->title = 'Tambah Session';
$this->params['breadcrumbs'][] = ['label' => 'Session', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="session-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
