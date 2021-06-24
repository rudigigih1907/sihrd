<?php

namespace app\traits;

use yii\helpers\ArrayHelper;

trait TraitMapIDToNama {
    public static function mapIDToNama() {
        return ArrayHelper::map(self::find()
            ->select("id, nama")
            ->orderBy('nama')
            ->all(), 'id', 'nama');
    }

    public static function mapIDToNamaOrderById() {
        return ArrayHelper::map(self::find()
            ->select("id, nama")
            ->orderBy('id')
            ->all(), 'id', 'nama');
    }

    public static function mapIDToNamaDenganKode() {
        return ArrayHelper::map(self::find()
            ->select("id, nama, kode")
            ->orderBy('kode')
            ->all(), 'id', function($model){
                return $model['kode'] . ' - ' . $model['nama'];
            });
    }

    public static function mapIDToKode() {
        return ArrayHelper::map(self::find()
            ->select("id, kode")
            ->orderBy('kode')
            ->all(), 'id', 'kode');
    }
}