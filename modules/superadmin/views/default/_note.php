<?php

/* @var $model Note */
/* @var $parser Markdown() */

use backend\models\Note;
use cebe\markdown\Markdown;
use common\models\User;

$formatter = Yii::$app->formatter;
?>

<p>
    <a class="btn btn-link  p-0" data-toggle="collapse" href="#collapseExample-<?= $model->id ?>" role="button"
       aria-expanded="false" aria-controls="collapseExample">
        <span class="text-navy text-md-left"><?= $model->title ?></span>
    </a>
</p>
<p>
    <span class="badge badge-success"><?= ucfirst($model->label->name) ?></span>
    <span class="badge badge-primary"><?= User::findOne($model->created_by)->username ?></span>
    <span class="badge badge-primary"><?= $formatter->asDatetime($model->created_at) ?></span>
    <span class="badge badge-secondary"><?= $model->status ?></span>
</p>

<div class="collapse" id="collapseExample-<?= $model->id ?>">
    <div class="card card-body">
        <p class="card-text">
            <?= $model->description ?>
        </p>
    </div>
</div>
<hr/>