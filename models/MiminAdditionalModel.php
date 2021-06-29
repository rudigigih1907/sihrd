<?php

namespace app\models;

use yii\base\Model;

class MiminAdditionalModel extends Model {
    public $generate_password;
    public $karyawan;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['karyawan'], 'required'],
            [['generate_password'], 'safe'],
        ];
    }
}