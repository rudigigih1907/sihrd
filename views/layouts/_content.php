<?php

/* @var $this \yii\web\View */
/* @var $content string */


use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs; ?>

<main class="mb-4">
    <div class="container-fluid">
        <div class="mt-4">
            <div class="d-flex justify-content-between">
                <h4><?php echo $this->title ?></h4>
                <?php try {
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>
            </div>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</main>
