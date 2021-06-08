<?php



/* @var $this \yii\web\View */
/* @var $model array|\backend\models\Session[] */

try {
    echo \common\widgets\Table::widget([
        'data' => $model
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}