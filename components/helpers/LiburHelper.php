<?php


namespace app\components\helpers;


use app\models\Libur;
use yii\db\Expression;

class LiburHelper {

    public static function statusLiburHariIni() {

        $data = Libur::find()
            ->where(new Expression(" tanggal = CURDATE()"))
            ->asArray()
            ->one();

        if (!empty($data)) {
            return [
                'status' => true,
                'data' => $data
            ];
        }

        return [
            'status' => false,
            'data' => []
        ];

    }

}