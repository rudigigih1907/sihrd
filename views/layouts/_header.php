<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

?>

<?php
NavBar::begin([
    'renderInnerContainer' => false,
    'brandLabel' => FAS::icon(FAS::_HOME) . " " . Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'sb-topnav navbar navbar-expand navbar-light bg-light shadow',
        /*'style' => [
            'background-color' => '#7952b3;',
        ]*/
    ],
]);
?>

<?= Html::button(FAS::icon(FAS::_BARS), [
    'id' => 'sidebarToggle',
    'class' => 'btn btn-link btn-sm order-1 order-lg-0',
    'href' => "#!"
]) ?>

<?php
//$c = Yii::$app->controller;
//try {
//
//    echo Nav::widget([
//        'options' => [
//            'class' => 'navbar-nav'
//        ],
//        'activateParents' => true,
//        'activateItems' => true,
//        'items' => [
//            [
//                'label' => Html::tag('span', $this->title, [
//                    'class' => 'letters'
//                ]),
//                'disabled' => true,
//                'options' => [
//                    'class' => 'ml10'
//                ],
//                'linkOptions' => [
//                    'class' => 'text-dark text-wrapper '
//                ]
//                /*'url' => ($c->module->id == 'basic') ? ['/' . $c->id] : ['/' . $c->module->id . '/' . $c->id],*/
//            ]
//        ],
//        'encodeLabels' => false,
//    ]);
//} catch (Exception $e) {
//    echo $e->getMessage();
//}
?>

<?php
try {
    echo Nav::widget([
        'options' => [
            'class' => 'navbar-nav ml-auto'
        ],
        'activateParents' => true,
        'activateItems' => true,
        'items' => [
            Yii::$app->user->isGuest ?
                [
                    'label' => '<i class="fas fa-sign-in-alt"></i> Login',
                    'active' => true,
                    'url' => ['/site/login'],
                ]
                :
                [
                    'label' => FAS::icon(FAS::_USER_CIRCLE) . ' ' . Yii::$app->user->identity->username,
                    'active' => true,
                    'dropdownOptions' => [
                        'class' => 'dropdown-menu dropdown-menu-right'
                    ],
                    'items' => [
                        [
                            'label' => '<i class="fas fa-directions"></i> ' . 'User Guide',
                            'url' => ['/user-guide/index'],
                        ],
                        '<div class="dropdown-divider"></div>',
                        [
                            'label' => '<i class="fas fa-user"></i> ' . 'Your Profile',
                            'url' => ['/site/profile'],
                        ],
                        [
                            'label' => FAS::icon(FAS::_SIGN_OUT_ALT) . 'Log Out',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']
                        ],
                    ],
                ]
        ],
        'encodeLabels' => false,
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<?php NavBar::end() ?>