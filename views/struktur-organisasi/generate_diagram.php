<?php

/* @var $this View */

use app\assets\TreeFlexAsset;
use app\components\helper\Tree;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\web\View;

/* @var $nodes array */

$this->title = 'Generate Diagram Struktur Organisasi';
$this->params['breadcrumbs'][] = ['label' => 'Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

TreeFlexAsset::register($this);
?>

<div class="struktur-organisasi-diagram">

    <div class="card shadow">
        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_SEARCH) . ' Back To Form',
                ['struktur-organisasi/generate-diagram'],
                ['class' => 'btn btn-primary'])
            ?>
        </div>

        <?= Html::beginTag("div", [
            'class' => 'tf-tree',
            'style' => [
                'white-space' => 'normal',
            ]
        ]); ?>

        <?= Tree::buildTreeOutAsHtmlUnOrderedList($nodes); ?>
        <?= Html::endTag("div"); ?>
    </div>

</div>
