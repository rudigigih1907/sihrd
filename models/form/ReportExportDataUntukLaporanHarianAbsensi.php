<?php


namespace app\models\form;


use yii\base\Model;

class ReportExportDataUntukLaporanHarianAbsensi extends Model {

    public $tanggal;

    public function rules() {
        return [
            ['tanggal', 'required'],
        ];
    }

}