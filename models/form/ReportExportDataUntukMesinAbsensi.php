<?php


namespace app\models\form;


use app\models\Karyawan;
use yii\base\Model;

class ReportExportDataUntukMesinAbsensi extends Model {

    public $statusAktif;

    public function rules() {
        return [
            [['statusAktif'], 'required'],
            ['statusAktif', 'in', 'range' => [
                Karyawan::AKTIF,
                Karyawan::TIDAK_AKTIF,
                Karyawan::SEMUA,
            ]
            ],
        ];
    }
}