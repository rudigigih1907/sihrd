<?php

namespace app\models;

use yii\base\Model;

class MiminAdditionalModel extends Model {
    public $generate_password;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['generate_password'], 'safe'],
        ];
    }
}