<?php

namespace app\models;

use hscstudio\mimin\models\AuthAssignment;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $karyawan_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \app\models\Karyawan $karyawan
 * @property string $aliasModel
 */
class User extends \mdm\admin\models\User {


    public $new_password, $old_password, $repeat_password;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan() {
        return $this->hasOne(\app\models\Karyawan::className(), ['id' => 'karyawan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(AuthAssignment::className(), [
            'user_id' => 'id',
        ]);
    }

    public function rules() {
        return ArrayHelper::merge(parent::rules(),[
            [['username', 'email'], 'required'],
            [['username', 'email', 'password_hash'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
            [['email'], 'email'],
            ['status','integer'],
            [['karyawan_id'], 'unique'],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']]
        ]);
    }


}
