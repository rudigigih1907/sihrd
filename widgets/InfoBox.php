<?php


namespace app\widgets;


use rmrevin\yii\fontawesome\FAS;
use yii\base\Widget;
use yii\helpers\Html;

class InfoBox extends Widget {

    public $icon = FAS::_ADDRESS_CARD;
    public $iconClass = 'text-dark' ;
    public $isCol = true;
    public $col = 'col-12 col-sm-6 col-md-3';
    public $boxClass = 'bg-light border';
    public $infoBoxText;
    public $infoBoxNumber = "Calculate";
    public $url = '#';
    public $urlTo = '#';

    public function run() {

        if($this->isCol) :
            echo Html::beginTag('div', ['class' => $this->col]); /* Begin Col */
        endif;

        /* Begin Info Box */
        echo Html::beginTag('div', [
            'class' => 'info-box mb-3 shadow',
            'data-url' => $this->url
        ]);

        echo Html::beginTag('span', [
            'class' => 'info-box-icon ' . $this->boxClass . ' elevation-1'
        ]);
        echo Html::tag('a',
            FAS::icon($this->icon), [
                'href' => $this->urlTo,
                'class' => $this->iconClass
            ]
        );
        echo Html::endTag('span');

        echo Html::beginTag('div', ['class' => 'info-box-content']); /* Begin Box Content */
        echo Html::tag('span', $this->infoBoxText, ['class' => 'info-box-text']);
        echo Html::tag('span', $this->infoBoxNumber, ['class' => 'info-box-number']);
        echo Html::endTag('div'); /* End Box Content */

        echo Html::endTag('div'); /* End Info Box */

        if($this->isCol) :
            echo Html::endTag('div'); /* End Col */
        endif;


    }

}