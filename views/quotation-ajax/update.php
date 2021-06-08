<?php

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
/* @var $modelsDetail app\models\QuotationJob */
/* @var $modelsDetailDetail app\models\QuotationJobDetail */
?>
<div class="quotation-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailDetail' => $modelsDetailDetail,
    ]) ?>

</div>
