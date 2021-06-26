<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "kehadiran_di_internal_sistem".
 *
 * @property integer $id
 * @property integer $jadwal_kerja_id
 * @property integer $jadwal_kerja_hari_id
 * @property integer $jam_kerja_id
 * @property string $tanggal
 * @property string $ketentuan_masuk
 * @property string $ketentuan_pulang
 * @property integer $karyawan_id
 * @property string $aktual_masuk
 * @property string $aktual_pulang
 * @property integer $jenis_izin_id
 * @property string $keterangan
 * @property integer $cuti_normatif_id
 *
 * @property \app\models\CutiNormatif $cutiNormatif
 * @property \app\models\JadwalKerja $jadwalKerja
 * @property \app\models\JadwalKerjaHari $jadwalKerjaHari
 * @property \app\models\JamKerja $jamKerja
 * @property \app\models\Karyawan $karyawan
 * @property \app\models\JenisIzin $jenisIzin
 * @property string $aliasModel
 */
abstract class KehadiranDiInternalSistem extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kehadiran_di_internal_sistem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id', 'ketentuan_masuk', 'ketentuan_pulang', 'karyawan_id'], 'required'],
            [['jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id', 'karyawan_id', 'jenis_izin_id', 'cuti_normatif_id'], 'integer'],
            [['tanggal', 'ketentuan_masuk', 'ketentuan_pulang', 'aktual_masuk', 'aktual_pulang'], 'safe'],
            [['keterangan'], 'string'],
            [['cuti_normatif_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\CutiNormatif::className(), 'targetAttribute' => ['cuti_normatif_id' => 'id']],
            [['jadwal_kerja_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JadwalKerja::className(), 'targetAttribute' => ['jadwal_kerja_id' => 'id']],
            [['jadwal_kerja_hari_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JadwalKerjaHari::className(), 'targetAttribute' => ['jadwal_kerja_hari_id' => 'id']],
            [['jam_kerja_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JamKerja::className(), 'targetAttribute' => ['jam_kerja_id' => 'id']],
            [['karyawan_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Karyawan::className(), 'targetAttribute' => ['karyawan_id' => 'id']],
            [['jenis_izin_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\JenisIzin::className(), 'targetAttribute' => ['jenis_izin_id' => 'id']]
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
            'jam_kerja_id' => 'Jam Kerja ID',
            'tanggal' => 'Tanggal',
            'ketentuan_masuk' => 'Ketentuan Masuk',
            'ketentuan_pulang' => 'Ketentuan Pulang',
            'karyawan_id' => 'Karyawan ID',
            'aktual_masuk' => 'Aktual Masuk',
            'aktual_pulang' => 'Aktual Pulang',
            'jenis_izin_id' => 'Jenis Izin ID',
            'keterangan' => 'Keterangan',
            'cuti_normatif_id' => 'Cuti Normatif ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCutiNormatif()
    {
        return $this->hasOne(\app\models\CutiNormatif::className(), ['id' => 'cuti_normatif_id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getKaryawan()
    {
        return $this->hasOne(\app\models\Karyawan::className(), ['id' => 'karyawan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisIzin()
    {
        return $this->hasOne(\app\models\JenisIzin::className(), ['id' => 'jenis_izin_id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\activequery\KehadiranDiInternalSistemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\activequery\KehadiranDiInternalSistemQuery(get_called_class());
    }


}
