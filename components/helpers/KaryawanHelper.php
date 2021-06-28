<?php


namespace app\components\helpers;


use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Json;
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

    private static function generatePathNode($array, $value = 'nama') {
        $max = isset($array)
            ? max(array_keys($array))
            : null;

        if(!is_null($max)){
             return $array[$max][$value];
        }

        return null;
    }

    /**
     * @param $dept
     * @return array|null
     */
    public static function generatePathJabatanUtama($dept) {

        if (isset($dept)) {

            $data = ArrayHelper::map(Json::decode($dept, true), 'level', function ($element) {
                return [
                    'kode' => $element['kode'],
                    'nama' => $element['nama'],
                    'singkatan' => $element['singkatan'],
                ];
            }, 'tipe');

            return [
                'group' => self::generatePathNode($data['group']),
                'perusahaan' => self::generatePathNode($data['perusahaan'], 'kode'),
                'cabang' => self::generatePathNode($data['cabang'], 'singkatan'),
                'departemen' => self::generatePathNode($data['departemen'], 'singkatan'),
                'jabatan' => self::generatePathNode($data['jabatan']),
            ];
        }

        return null;
    }
}