<?php

use app\models\MiminAdditionalModel;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\User */
/* @var $additionalModel MiminAdditionalModel*/

$this->title = 'Update User: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

	<?= $this->render('_form', [
		'model' => $model,
        'additionalModel' => $additionalModel,
	]) ?>

</div>
