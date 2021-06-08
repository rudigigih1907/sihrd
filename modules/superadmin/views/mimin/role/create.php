<?php


/* @var $this yii\web\View */
/* @var $model \hscstudio\mimin\models\AuthItem */

$this->title = 'Create Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
