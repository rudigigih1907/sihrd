<?php

use app\models\MiminAdditionalModel;
use hscstudio\mimin\models\User;

/* @var $this yii\web\View */
/* @var $model User*/
/* @var $additionalModel MiminAdditionalModel*/


$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
        'additionalModel' => $additionalModel,
    ]) ?>

</div>
