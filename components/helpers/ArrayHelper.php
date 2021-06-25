<?php


namespace app\components\helpers;


use yii\helpers\Inflector;

class ArrayHelper extends \yii\helpers\ArrayHelper {

    /**
     * @param $array
     * @param int $first
     * @return array
     */
    public static function getFirstAndLastElement($array, $first = 0) {
        return array_map(function ($element) use ($first) {
            $breakingChain = explode("->", $element);
            return Inflector::humanize(end($breakingChain));
        }, $array);
    }

}