<?php


namespace app\components\helpers;


use yii\helpers\Inflector;
use yii\web\HttpException;

class KaryawanHelper extends \yii\helpers\ArrayHelper {

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

    public static function generateDept(array $kodeMenjabat, array $menjabat) {
        if (count($kodeMenjabat) != count($menjabat)) throw new HttpException(500, 'Kode dan nama jabatan tidak match');

        $pecahKode = array_map(function($el){
            $node = explode("->", $el);
            return $node[1];
        }, $kodeMenjabat);

        $pecahNama = array_map(function($el){
            $node = explode("->", $el);
            return end($node);
        }, $menjabat);


        $newArray = [];

        foreach ($pecahKode as $key => $item) {
            $newArray[] = $item . ', ' . $pecahNama[$key];
        }
        return $newArray;
    }

}