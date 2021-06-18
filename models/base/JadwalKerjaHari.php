<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "jadwal_kerja_hari".
 *
 * @property integer $id
 * @property string $nama
 * @property string $asli
 * @property string $default_libur
 *
 * @property \app\models\JadwalKerjaDetail[] $jadwalKerjaDetails
 * @property string $aliasModel
 */
abstract class JadwalKerjaHari extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const ASLI_YA = 'Ya';
    const ASLI_TIDAK = 'Tidak';
    const DEFAULT_LIBUR_YA = 'Ya';
    const DEFAULT_LIBUR_TIDAK = 'Tidak';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal_kerja_hari';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['asli', 'default_libur'], 'string'],
            [['nama'], 'string', 'max' => 255],
            ['asli', 'in', 'range' => [
                    self::ASLI_YA,
                    self::ASLI_TIDAK,
                ]
            ],
            ['default_libur', 'in', 'range' => [
                    self::DEFAULT_LIBUR_YA,
                    self::DEFAULT_LIBUR_TIDAK,
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
            'asli' => 'Asli',
            'default_libur' => 'Default Libur',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalKerjaDetails()
    {
        return $this->hasMany(\app\models\JadwalKerjaDetail::className(), ['jadwal_kerja_hari_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\JadwalKerjaHariQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\JadwalKerjaHariQuery(get_called_class());
    }


    /**
     * get column asli enum value label
     * @param string $value
     * @return string
     */
    public static function getAsliValueLabel($value){
        $labels = self::optsAsli();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column asli ENUM value labels
     * @return array
     */
    public static function optsAsli()
    {
        return [
            self::ASLI_YA => 'Ya',
            self::ASLI_TIDAK => 'Tidak',
        ];
    }

    /**
     * get column default_libur enum value label
     * @param string $value
     * @return string
     */
    public static function getDefaultLiburValueLabel($value){
        $labels = self::optsDefaultLibur();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column default_libur ENUM value labels
     * @return array
     */
    public static function optsDefaultLibur()
    {
        return [
            self::DEFAULT_LIBUR_YA => 'Ya',
            self::DEFAULT_LIBUR_TIDAK => 'Tidak',
        ];
    }

}