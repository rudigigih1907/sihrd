<?php


namespace app\widgets;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Inflector;

class PDFSignatureWidget extends Widget {

    public $data;

    /**
     * @throws InvalidConfigException
     */
    public function init() {
        parent::init();
        if ($this->data == null) {
            throw new InvalidConfigException("Data harus diset", 0);
        }
    }


    public function run() {
        echo Html::beginTag('table', ['class' => 'signature']);
        echo Html::beginTag('tbody');
        echo Html::beginTag('tr');

        foreach ($this->data as $key => $value) {
            echo Html::beginTag('td');

            echo Html::beginTag('div',['class' => 'title']);
            echo Html::beginTag('p');
            echo Inflector::humanize($key);
            echo Html::endTag('p');
            echo Html::endTag('div');

            echo Html::beginTag('div',['class' => 'signature']);
            echo Html::beginTag('p');
            echo "<br/> <br/> <br/> <br/>";
            echo Html::endTag('p');
            echo Html::endTag('div');

            echo Html::beginTag('div',['class' => 'person-name']);
            echo Html::beginTag('p');
            echo $value;
            echo Html::endTag('p');
            echo Html::endTag('div');

            echo Html::endTag('td');
        }
        echo Html::endTag('tr');
        echo Html::endTag('tbody');
        echo Html::endTag('table');
    }

}