<?php


namespace app\models\form;


use yii\base\Model;

class ImportKehadiranDiInternalSistemAbsensiJamPulang extends Model {

    public $tanggal;
    public $pindahHari;

    public function rules() {
        return [
            ['tanggal', 'required'],
            ['pindahHari', 'integer'],
            ['pindahHari', 'default', 'value' => 0]
        ];
    }

}