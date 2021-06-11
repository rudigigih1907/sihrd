<?php

namespace app\traits;

use yii\helpers\ArrayHelper;

trait TraitMapIDToNomorReferensi {
    public static function mapIDToNomorReferensi() {
        return ArrayHelper::map(self::find()
            ->select("id, nomor_referensi")
            ->orderBy('nomor_referensi')
            ->all(), 'id', 'nomor_referensi');
    }
}