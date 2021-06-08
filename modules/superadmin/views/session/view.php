<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Session */
?>
<div class="session-view">

        
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
               'expire',
           'data',
           'user_id',
           'last_write',
        ],
    ]) ?>

</div>