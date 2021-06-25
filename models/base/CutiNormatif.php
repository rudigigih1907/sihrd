<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "cuti_normatif".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $lama
 * @property string $dibayar
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property \app\models\KehadiranDiInternalSistem[] $kehadiranDiInternalSistems
 * @property string $aliasModel
 */
abstract class CutiNormatif extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const DIBAYAR_YA = 'Ya';
    const DIBAYAR_TIDAK = 'Tidak';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuti_normatif';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'lama'], 'required'],
            [['lama'], 'integer'],
            [['dibayar'], 'string'],
            [['nama'], 'string', 'max' => 255],
            ['dibayar', 'in', 'range' => [
                    self::DIBAYAR_YA,
                    self::DIBAYAR_TIDAK,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'lama' => 'Lama',
            'dibayar' => 'Dibayar',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'lama' => 'Dalam Satuan Hari',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKehadiranDiInternalSistems()
    {
        return $this->hasMany(\app\models\KehadiranDiInternalSistem::className(), ['cuti_normatif_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\CutiNormatifQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\CutiNormatifQuery(get_called_class());
    }


    /**
     * get column dibayar enum value label
     * @param string $value
     * @return string
     */
    public static function getDibayarValueLabel($value){
        $labels = self::optsDibayar();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column dibayar ENUM value labels
     * @return array
     */
    public static function optsDibayar()
    {
        return [
            self::DIBAYAR_YA => 'Ya',
            self::DIBAYAR_TIDAK => 'Tidak',
        ];
    }

}
