<?php
/* @var $this yii\web\View */
/* @var $model app\models\CutiNormatif */
use yii\helpers\Html;

$this->title = 'Tambah Cuti Normatif';
$this->params['breadcrumbs'][] = ['label' => 'Cuti Normatif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="cuti-normatif-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
