<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body class="sb-nav-fixed">

    <?php $this->beginBody() ?>

    <?php echo $this->render('_header') ?>

    <div id="layoutSidenav">

        <?= $this->render('_sidebar') ?>

        <div id="layoutSidenav_content">

            <?= $this->render('_content', [
                    'content' => $content
            ]) ?>

            <?= $this->render('_footer') ?>

        </div>

    </div>
    <?php $this->endBody() ?>

    </body>

    </html>
<?php $this->endPage() ?>