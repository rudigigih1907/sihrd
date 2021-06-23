<?php

use yii\db\Migration;

/**
 * Class m210623_063943_CreateKehadiranDiSistemInternalDenganIzinRelation
 */
class m210623_063943_CreateKehadiranDiSistemInternalDenganIzinRelation extends Migration
{

    private $table = '{{%kehadiran_di_internal_sistem}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'jenis_izin_id', $this->integer()->null());

        $this->createIndex("idx_jenis_izin_di_kehadiran_internal_sistem", $this->table,
            "jenis_izin_id"
        );

        $this->addForeignKey("idx_jenis_izin_di_kehadiran_internal_sistem", $this->table,
            "jenis_izin_id",
            'jenis_izin',
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
        $this->dropForeignKey("idx_jenis_izin_di_kehadiran_internal_sistem", $this->table);
        $this->dropIndex("idx_jenis_izin_di_kehadiran_internal_sistem", $this->table);
        $this->dropColumn($this->table, 'jenis_izin_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210623_063943_CreateKehadiranDiSistemInternalDenganIzinRelation cannot be reverted.\n";

        return false;
    }
    */
}
