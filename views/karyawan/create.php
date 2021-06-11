<?php

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $modelsDetail app\models\AlamatKaryawan */

$this->title = 'Tambah Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="karyawan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>
</div>
