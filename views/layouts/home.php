<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Breadcrumbs;
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

        <?php
        $callback = function ($item) {

            $data = eval($item['data']);

            if (isset($data['module'])) {
                return isset($data['controller'])
                    ?
                    [
                        'label' => $item['name'],
                        'url' => [$item['route']],
                        'items' => $item['children'],
                        'active' =>
                            Yii::$app->controller->module->id == $data['module'] &&
                            Yii::$app->controller->id == $data['controller']
                    ]
                    :
                    [
                        'label' => $item['name'],
                        'url' => is_null($item['route']) ? "#" : [$item['route']],
                        'items' => $item['children'],
                        'active' => null
                    ];


            }

            return isset($data['controller'])
                ?
                [
                    'label' => $item['name'],
                    'url' => [$item['route']],
                    'items' => $item['children'],
                    'active' => Yii::$app->controller->id == $data['controller']
                ]
                :
                [
                    'label' => $item['name'],
                    'url' => is_null($item['route']) ? "#" : [$item['route']],
                    'items' => $item['children'],
                    'active' => null
                ];
        };
        $items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback);
        echo $this->render('_sidebar', ['items' => $items])
        ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="mt-4">
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>
            </main>
            <?= $this->render('_footer') ?>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>