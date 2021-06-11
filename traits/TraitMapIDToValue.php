<?php

namespace app\traits;

use yii\helpers\ArrayHelper;

trait TraitMapIDToValue {
    public function mapIDToValue() {
        return ArrayHelper::map(self::find()
            ->select("id,value")
            ->orderBy('value')
            ->all(), 'id', 'value');
    }
}