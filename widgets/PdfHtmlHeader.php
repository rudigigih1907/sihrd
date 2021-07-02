<?php

namespace widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class PdfHtmlHeader extends Widget {

    public $renderMediaAsPdf = true;
    private $imgRenderPath = '/img/logo-tms.png';

    public function init() {
        parent::init();
    }

    public function run() {

        if($this->renderMediaAsPdf){
            $this->imgRenderPath = "." .$this->imgRenderPath;
        }
        $this->renderLayout();
    }

    public function renderLayout() {

        /* Begin Row */
        echo Html::beginTag('div', [
            'class' => 'row'
        ]);

        /* ============ Image ==============*/
        echo Html::beginTag('div', [
            'style' => [
                'float' => "left",
                "width" => "10%",
                //'border' => '1px solid black'
            ]
        ]);
        echo Html::img($this->imgRenderPath, [
            'style' => [
                'width' => '80px',
                'height' => '80px',
            ]
        ]);
        echo Html::endTag('div');
        /* ============ Image ==============*/


        /* ======== Company =============== */
        echo Html::beginTag('div',[
            'style' => [
                'float' => "left",
                "width" => "89%",
                //'border' => '1px solid black',
                'text-align' => 'center',
                'padding' => '0'
            ]
        ]);
        echo "<h3>Tresnamuda Group</h3>";
        echo "<p style='margin: 0'>Komplek Ruko Sunter Permai Indah Jl. Mitra Sunter Boulevard. Block B No. 12-16. Jakarta 14350. Indonesia. <br/> Phone: (021) 6522333 (Hunting). Fax: (021) 6522336/37</p>";

        echo Html::endTag('div');
        /* ======== Company =============== */

        echo Html::endTag('div');
        /* End Row */

        echo "<div style='  content: \"\"; clear: both; display: table;'> </div>";
        echo '<hr style="border-top: 1px solid red;"/>';

    }


}