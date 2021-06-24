<?php


namespace app\models\form;


use yii\base\Model;

class ImportKehadiranMasukDiInternalSistemAbsensi extends Model {

    public $tanggalMasuk;

    public function rules() {
        return [
            ['tanggalMasuk', 'required']
        ];
    }

}