<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Routes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-view">

    <div class="card shadow">
        <div class="card-header p-3">
            <?= Html::a('Update', ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

        <?php try {
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'alias',
                    'type',
                    'status',
                ],
            ]);
        } catch (Exception $e) {
        } ?>

        <div class="card-footer"></div>

    </div>
</div>
