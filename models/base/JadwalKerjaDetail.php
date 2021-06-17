<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "jadwal_kerja_detail".
 *
 * @property integer $id
 * @property integer $jadwal_kerja_id
 * @property integer $jadwal_kerja_hari_id
 * @property string $libur
 * @property integer $jam_kerja_id
 *
 * @property \app\models\JadwalKerja $jadwalKerja
 * @property \app\models\JadwalKerjaHari $jadwalKerjaHari
 * @property \app\models\JamKerja $jamKerja
 * @property string $aliasModel
 */
abstract class JadwalKerjaDetail extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const LIBUR_YA = 'Ya';
    const LIBUR_TIDAK = 'Tidak';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal_kerja_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id'], 'integer'],
            [['jadwal_kerja_hari_id'], 'required'],
            [['libur'], 'string'],
            [['jadwal_kerja_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JadwalKerja::className(), 'targetAttribute' => ['jadwal_kerja_id' => 'id']],
            [['jadwal_kerja_hari_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JadwalKerjaHari::className(), 'targetAttribute' => ['jadwal_kerja_hari_id' => 'id']],
            [['jam_kerja_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JamKerja::className(), 'targetAttribute' => ['jam_kerja_id' => 'id']],
            ['libur', 'in', 'range' => [
                    self::LIBUR_YA,
                    self::LIBUR_TIDAK,
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
            'jadwal_kerja_id' => 'Jadwal Kerja ID',
            'jadwal_kerja_hari_id' => 'Jadwal Kerja Hari ID',
            'libur' => 'Libur',
            'jam_kerja_id' => 'Jam Kerja ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalKerja()
    {
        return $this->hasOne(\app\models\JadwalKerja::className(), ['id' => 'jadwal_kerja_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwalKerjaHari()
    {
        return $this->hasOne(\app\models\JadwalKerjaHari::className(), ['id' => 'jadwal_kerja_hari_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJamKerja()
    {
        return $this->hasOne(\app\models\JamKerja::className(), ['id' => 'jam_kerja_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\JadwalKerjaDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\JadwalKerjaDetailQuery(get_called_class());
    }


    /**
     * get column libur enum value label
     * @param string $value
     * @return string
     */
    public static function getLiburValueLabel($value){
        $labels = self::optsLibur();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column libur ENUM value labels
     * @return array
     */
    public static function optsLibur()
    {
        return [
            self::LIBUR_YA => 'Ya',
            self::LIBUR_TIDAK => 'Tidak',
        ];
    }

}
