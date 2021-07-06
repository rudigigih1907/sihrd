<?php



/* @var $this \yii\web\View */
/* @var $records array  */

?>

<div class="card shadow" id="crud">
    <?= \yii\helpers\Html::tag('pre',
        \yii\helpers\VarDumper::dumpAsString($records)
    ) ?>
</div>
