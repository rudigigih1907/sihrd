<?php

use yii\db\Migration;

/**
 * Class m210623_061736_CreateKehadiranDiSistemInternalRelation
 */
class m210623_061736_CreateKehadiranDiSistemInternalRelation extends Migration {

    private $table = '{{%kehadiran_di_internal_sistem}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->addForeignKey("fk_jadwal_kerja_di_kehadiran_internal_sistem", $this->table,
            'jadwal_kerja_id',
            'jadwal_kerja',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey("fk_jadwal_kerja_hari_di_kehadiran_internal_sistem", $this->table,
            'jadwal_kerja_hari_id',
            'jadwal_kerja_hari',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey("fk_jam_kerja_di_kehadiran_internal_sistem", $this->table,
            'jam_kerja_id',
            'jam_kerja',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey("fk_karyawan_di_kehadiran_internal_sistem", $this->table,
            'karyawan_id',
            'karyawan',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey("fk_jadwal_kerja_di_kehadiran_internal_sistem", $this->table);
        $this->dropForeignKey("fk_jadwal_kerja_hari_di_kehadiran_internal_sistem", $this->table);
        $this->dropForeignKey("fk_jam_kerja_di_kehadiran_internal_sistem", $this->table);
        $this->dropForeignKey("fk_karyawan_di_kehadiran_internal_sistem", $this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210623_061736_CreateKehadiranDiSistemInternalRelation cannot be reverted.\n";

        return false;
    }
    */
}
