<?php


namespace app\models\form;


use yii\base\Model;

class FormBatchUpdateUangKehadiranPerHari extends Model {

    public $tanggal;
    

    public function rules() {
        return [
            ['tanggal', 'required'],
        ];
    }

}