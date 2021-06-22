<?php

use yii\db\Migration;

/**
 * Class m210622_103454_AlterNamaAbsensiTable
 */
class m210622_103454_AlterNamaAbsensiTable extends Migration
{

    private $table = "{{absensi}}";
    private $newTable = "{{mesin_absensi}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey("idx_absensi_karyawan", $this->table);
        $this->dropIndex("idx_absensi_karyawan", $this->table);
        $this->renameTable($this->table, $this->newTable);
        $this->createIndex("idx_mesin_absensi_karyawan", $this->newTable, 'karyawan_id');
        $this->addForeignKey("fk_mesin_absensi_karyawan", $this->newTable,
            'karyawan_id',
            'karyawan',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_mesin_absensi_karyawan", $this->newTable);
        $this->dropIndex("idx_mesin_absensi_karyawan", $this->newTable);
        $this->renameTable($this->newTable, $this->table);
        $this->createIndex("idx_absensi_karyawan", $this->table, 'karyawan_id');
        $this->addForeignKey("idx_absensi_karyawan", $this->table,
            'karyawan_id',
            'karyawan',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210622_103454_AlterNamaAbsensiTable cannot be reverted.\n";

        return false;
    }
    */
}
