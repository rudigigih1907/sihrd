<?php


namespace app\widgets;


use Yii;
use yii\base\Widget;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

class Table extends Widget {

    public $data;
    public $skippedColumns;
    public $classTable = 'table table-condensed table-bordered table-striped';
    public $defaultAlign = "text-left";
    public $rightAlign = "text-right";


    public function init() {

    }


    private function stringStyleHeader($string) {
        return strtoupper(str_replace("_", " ", $string));
    }

    /**
     * Void
     * @param $headers
     */
    private function renderHeaderTable($headers) {
        echo Html::beginTag('thead');
        echo Html::beginTag('tr');

        echo Html::beginTag('th', [
                'style' => 'width : 2px; white-space : nowrap',
                'class' => 'text-right'
            ]) . 'NO';

        echo Html::endTag('th');

        if (empty($this->skippedColumns)) {
            foreach ($headers as $header):
                if ($header == 'id') {
                    continue;
                }
                echo Html::beginTag('th', [
                    'class' => 'text-center',
                    'style' => [
                        'white-space' => 'nowrap'
                    ]
                ]);
                echo $this->stringStyleHeader($header);
                echo Html::endTag('th');

            endforeach;
        } else {
            foreach ($headers as $header):
                if ($header == 'id' || in_array($header, $this->skippedColumns)) {
                    continue;
                }
                echo Html::beginTag('th', [
                    'class' => 'text-center',
                    'style' => [
                        'white-space' => 'nowrap'
                    ]
                ]);
                echo $this->stringStyleHeader($header);
                echo Html::endTag('th');

            endforeach;
        }

        echo Html::endTag('tr');
        echo Html::endTag('thead');
    }

    /**
     * Void
     * @param $data
     */
    private function renderBodyTable($data) {
        echo Html::beginTag('tbody');

        foreach ($data as $key => $datum):
            echo Html::beginTag('tr');
            echo Html::beginTag('td', [
                        'style' => [
                            'white-space' => 'nowrap'
                        ],
                        'class' => 'text-right',
                    ]
                ) . ($key + 1);
            echo Html::endTag('td');


            if (empty($this->skippedColumns)) {
                foreach ($datum as $subKey => $item):

                    if ($subKey == 'id') {
                        continue;
                    }

                    // Check number
                    if (isset($item['type'])) {
                        echo Html::beginTag('td', [
                                'style' => [
                                    'white-space' => 'nowrap'
                                ],
                                'class' => $this->rightAlign
                            ]) . $item['value'];
                    } else {
                        echo Html::beginTag('td', [
                                /*'style' => [
                                    'white-space' => 'nowrap'
                                ],*/
                                'class' => $this->defaultAlign
                            ]) . $item;
                    }
                    echo Html::endTag('td');
                endforeach;
            } else {

                foreach ($datum as $subKey => $item):
                    if ($subKey == 'id' || in_array($subKey, $this->skippedColumns)) {
                        continue;
                    }

                    // Check number
                    if (isset($item['type'])) {
                        echo Html::beginTag('td', [
                                'style' => [
                                    'white-space' => 'nowrap'
                                ],
                                'class' => $this->rightAlign
                            ]) . $item['value'];
                    } else {
                        echo Html::beginTag('td', [
                                'style' => [
                                    'white-space' => 'nowrap'
                                ],
                                'class' => $this->defaultAlign
                            ]) . $item;
                    }
                endforeach;
            }

            echo Html::endTag('tr');
        endforeach;
        echo Html::endTag('tbody');
    }

    private function renderFooterTable($data) {
        $total = [];
        foreach ($data as $key => $datum):
            if (empty($this->skippedColumns)) {
                foreach ($datum as $subKey => $item):
                    if ($subKey == 'id') {
                        continue;
                    }

                    // Check countable
                    if (isset($item['type']) && ($item['countable'] == true)) {
                        $total[$subKey][$item['type']][] = $item['value'];
                    } else {
                        $total[$subKey] = null;
                    }
                endforeach;
            }
        endforeach;


        if(!empty(array_filter($total))){

            $headerKeys = array_keys($data[0]);

            echo Html::beginTag('tfoot');
            echo Html::beginTag('tr');

            echo Html::beginTag('th', ['style' => 'width : 2px; white-space : nowrap', 'class' => 'text-right']);
            echo Html::endTag('th');

            foreach ($headerKeys as $key => $item) {

                if (isset($total[$item])) {

                    echo Html::beginTag('td', ['class' => 'text-right']);

                    if (isset($total[$item]['integer'])) {
                        echo Yii::$app->formatter->asDecimal(array_sum($total[$item]['integer']), 0);
                    } else if (isset($total[$item]['decimal'])) {
                        echo Yii::$app->formatter->asDecimal(array_sum(array_map(function ($value) {
                                return floatval(str_replace(",", "", $value));
                            }, $total[$item]['decimal'])
                        ), 2);
                    }
                    echo Html::endTag('/td');
                } else {
                    echo Html::beginTag('td', ['class' => 'text-right',]);
                    echo Html::endTag('/td');
                }
            }

            echo Html::endTag('tr');
            echo Html::endTag('tfoot');
        }

    }


    public function run() {

        if (!empty($this->data)):

            $this->data = ArrayHelper::toArray($this->data);
            $headers = array_keys($this->data[0]);


            echo Html::beginTag('div', ['style' => [
                'overflow-y' => 'auto'
            ]]);
            echo Html::beginTag('table', ['class' => $this->classTable]);

            $this->renderHeaderTable($headers);
            $this->renderBodyTable($this->data);
            $this->renderFooterTable($this->data);

            echo Html::endTag('table');
            echo Html::endTag('div');
        endif;
    }
}

