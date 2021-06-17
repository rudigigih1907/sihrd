<?php

/* @var $this View */
/* @var $content string */
use yii\web\View;

use app\widgets\SideMenu;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Html;

$callback = function ($item) {

    $data = eval($item['data']);

    if (isset($data['module'])) {
        return isset($data['controller'])
            ?
            [
                'label' => $item['name'],
                'url' => [$item['route']],
                'items' => $item['children'],
                'icon' => $data['icon'],
                'active' =>
                    Yii::$app->controller->module->id == $data['module'] &&
                    Yii::$app->controller->id == $data['controller']
            ]
            :
            [
                'label' => $item['name'],
                'url' => is_null($item['route']) ? "#" : [$item['route']],
                'items' => $item['children'],
                'icon' => $data['icon'],
                'active' => null
            ];


    }

    return isset($data['controller'])
        ?
        [
            'label' => $item['name'],
            'url' => [$item['route']],
            'items' => $item['children'],
            'icon' => $data['icon'],
            'active' => Yii::$app->controller->id == $data['controller']
        ]
        :
        [
            'label' => $item['name'],
            'url' => is_null($item['route']) ? "#" : [$item['route']],
            'items' => $item['children'],
            'icon' => $data['icon'],
            'active' => null
        ];
};
$items = MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback);

$isGuest = Yii::$app->user->isGuest;
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light shadow" id="sidenavAccordion">
        <div class="sb-sidenav-menu ">
            <div class="nav pt-3">
                <?php
                try {
                    echo (!$isGuest)
                        ? SideMenu::widget([
                            'items' => $items,
                            'options' => [
                                'tag' => false
                            ],
                            'itemOptions' => [
                                'tag' => false,
                            ],
                            'activateItems' => true,
                            'activateParents' => true,
                        ])
                        : Html::a('<div class="sb-nav-link-icon"><i class="fas fa-sign-in-alt"></i></div> Login', ['/site/login'], [
                            'class' => 'nav-link'
                        ]);

                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">

            <div class="small">Logged in as:</div>

            <span class="ml10">
                <span class="letters">
                    <?php echo ($isGuest) ? "Guest" : Yii::$app->user->identity->username ?>
                </span>
            </span>


        </div>
    </nav>
</div>


<!--<div id="layoutSidenav">
    <div id="layoutSidenav_nav">

        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

            <div class="sb-sidenav-menu">

                <div class="nav">

                    <a class="nav-link" href="index.html">
                        Dashboard
                    </a>

                    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="true" aria-controls="collapseLayouts">
                        Layouts
                    </a>

                    <div class="collapse show" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion" style="">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link active" href="layout-static.html">Static Navigation</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        Pages
                    </a>

                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                            </a>

                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                            </a>

                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">

                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">

                        Tables
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>

</div>-->






