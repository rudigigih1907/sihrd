<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "karyawan_ptkp".
 *
 * @property integer $id
 * @property integer $karyawan_id
 * @property integer $hubungan_ptkp_id
 * @property string $nama_tanggungan
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $terhitung_sebagai_ptkp
 * @property integer $batal_ptkp_id
 *
 * @property \app\models\BatalPtkp $batalPtkp
 * @property \app\models\HubunganPtkp $hubunganPtkp
 * @property \app\models\Karyawan $karyawan
 * @property string $aliasModel
 */
abstract class KaryawanPtkp extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const TERHITUNG_SEBAGAI_PTKP_YA = 'Ya';
    const TERHITUNG_SEBAGAI_PTKP_TIDAK = 'Tidak';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'karyawan_ptkp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['karyawan_id', 'hubungan_ptkp_id', 'nama_tanggungan', 'tempat_lahir', 'tanggal_lahir'], 'required'],
            [['karyawan_id', 'hubungan_ptkp_id', 'batal_ptkp_id'], 'integer'],
            [['tanggal_lahir'], 'safe'],
            [['terhitung_sebagai_ptkp'], 'string'],
            [['nama_tanggungan', 'tempat_lahir'], 'string', 'max' => 255],
            [['batal_ptkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\BatalPtkp::className(), 'targetAttribute' => ['batal_ptkp_id' => 'id']],
            [['hubungan_ptkp_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\HubunganPtkp::className(), 'targetAttribute' => ['hubungan_ptkp_id' => 'id']],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']],
            ['terhitung_sebagai_ptkp', 'in', 'range' => [
                    self::TERHITUNG_SEBAGAI_PTKP_YA,
                    self::TERHITUNG_SEBAGAI_PTKP_TIDAK,
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
            'karyawan_id' => 'Karyawan ID',
            'hubungan_ptkp_id' => 'Hubungan Ptkp ID',
            'nama_tanggungan' => 'Nama Tanggungan',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'terhitung_sebagai_ptkp' => 'Terhitung Sebagai Ptkp',
            'batal_ptkp_id' => 'Batal Ptkp ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'batal_ptkp_id' => 'Alasan Tidak Terhitung',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatalPtkp()
    {
        return $this->hasOne(\app\models\BatalPtkp::className(), ['id' => 'batal_ptkp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHubunganPtkp()
    {
        return $this->hasOne(\app\models\HubunganPtkp::className(), ['id' => 'hubungan_ptkp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(\app\models\Karyawan::className(), ['id' => 'karyawan_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\KaryawanPtkpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\KaryawanPtkpQuery(get_called_class());
    }


    /**
     * get column terhitung_sebagai_ptkp enum value label
     * @param string $value
     * @return string
     */
    public static function getTerhitungSebagaiPtkpValueLabel($value){
        $labels = self::optsTerhitungSebagaiPtkp();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column terhitung_sebagai_ptkp ENUM value labels
     * @return array
     */
    public static function optsTerhitungSebagaiPtkp()
    {
        return [
            self::TERHITUNG_SEBAGAI_PTKP_YA => 'Ya',
            self::TERHITUNG_SEBAGAI_PTKP_TIDAK => 'Tidak',
        ];
    }

}
