<?php

use yii\db\Migration;

/**
 * Class m210618_061635_CreateKaryawanDenganJadwalKerjaRelation
 */
class m210618_061635_CreateKaryawanDenganJadwalKerjaRelation extends Migration
{

    private $table = "{{karyawan}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'jadwal_kerja_id',
            $this->integer()->notNull()->after('alasan_berhenti_bekerja')
        );

        $this->createIndex('idx_jadwal_kerja_di_karyawan', 'karyawan', 'jadwal_kerja_id');
        $this->addForeignKey('fk_jadwal_kerja_di_karyawan', 'karyawan',
            'jadwal_kerja_id',
            'jadwal_kerja',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_jadwal_kerja_di_karyawan', 'karyawan');
        $this->dropIndex('idx_jadwal_kerja_di_karyawan', 'karyawan');
        $this->dropColumn($this->table, 'jadwal_kerja_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210618_061635_CreateKaryawanDenganJadwalKerjaRelation cannot be reverted.\n";

        return false;
    }
    */
}
