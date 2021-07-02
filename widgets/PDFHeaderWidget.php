<?php


namespace app\widgets;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;

class PDFHeaderWidget extends Widget {

    public $title;
    public $qrCode;
    public $logo;

    public function init() {
        parent::init();
        if ($this->title == null) {
            throw new InvalidConfigException("Title  harus diset", 0);
        }
    }

    public function renderOneLayout(){
        echo Html::beginTag('h4');
        echo $this->title;
        echo Html::endTag('h4');
        echo Html::endTag('div');
    }

    public function renderTwoLayout() {
        echo Html::beginTag('div', ['style' => ['float' => 'left', 'width' => '85%',]]);
        echo Html::beginTag('h4');
        echo $this->title;
        echo Html::endTag('h4');
        echo Html::endTag('div');

        echo Html::beginTag('div', ['style' => ['float' => 'right', 'width' => '15%', 'text-align' => 'right']]);
        echo ' <barcode code="' . $this->qrCode . '" type="QR" class="barcode" size="0.5" error="M"> </barcode>';
        echo Html::endTag('div');

        echo Html::tag('div','',[
            'style' => [
                'clear' => 'both'
            ]
        ]);
    }

    public function run() {
        echo Html::beginTag('div', ['id' => 'report-header']);
        if($this->qrCode == null){
            $this->renderOneLayout();
        }else{
            $this->renderTwoLayout();
        }

        echo Html::beginTag('div', ['style' => ['clear' => 'both']]);
        echo Html::endTag('div');

        echo Html::endTag('div');
    }

}