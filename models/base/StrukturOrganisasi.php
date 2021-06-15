<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "struktur_organisasi".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $tipe
 * @property string $nama
 * @property string $alias
 * @property string $kode
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property \app\models\StrukturOrganisasi $parent
 * @property \app\models\StrukturOrganisasi[] $strukturOrganisasis
 * @property string $aliasModel
 */
abstract class StrukturOrganisasi extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const TIPE_GROUP = 'GROUP';
    const TIPE_PERUSAHAAN = 'PERUSAHAAN';
    const TIPE_CABANG = 'CABANG';
    const TIPE_DEPARTEMEN = 'DEPARTEMEN';
    const TIPE_JABATAN = 'JABATAN';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'struktur_organisasi';
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
            [['parent_id'], 'integer'],
            [['tipe', 'nama', 'kode'], 'required'],
            [['tipe'], 'string'],
            [['nama', 'alias'], 'string', 'max' => 255],
            [['kode'], 'string', 'max' => 100],
            [['kode'], 'unique'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\StrukturOrganisasi::className(), 'targetAttribute' => ['parent_id' => 'id']],
            ['tipe', 'in', 'range' => [
                    self::TIPE_GROUP,
                    self::TIPE_PERUSAHAAN,
                    self::TIPE_CABANG,
                    self::TIPE_DEPARTEMEN,
                    self::TIPE_JABATAN,
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
            'parent_id' => 'Parent ID',
            'tipe' => 'Tipe',
            'nama' => 'Nama',
            'alias' => 'Alias',
            'kode' => 'Kode',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(\app\models\StrukturOrganisasi::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrukturOrganisasis()
    {
        return $this->hasMany(\app\models\StrukturOrganisasi::className(), ['parent_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\StrukturOrganisasiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\StrukturOrganisasiQuery(get_called_class());
    }


    /**
     * get column tipe enum value label
     * @param string $value
     * @return string
     */
    public static function getTipeValueLabel($value){
        $labels = self::optsTipe();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column tipe ENUM value labels
     * @return array
     */
    public static function optsTipe()
    {
        return [
            self::TIPE_GROUP => 'Group',
            self::TIPE_PERUSAHAAN => 'Perusahaan',
            self::TIPE_CABANG => 'Cabang',
            self::TIPE_DEPARTEMEN => 'Departemen',
            self::TIPE_JABATAN => 'Jabatan',
        ];
    }

}