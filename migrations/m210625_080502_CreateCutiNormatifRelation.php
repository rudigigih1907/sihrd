<?php

use yii\db\Migration;

/**
 * Class m210625_080502_CreateCutiNormatifRelation
 */
class m210625_080502_CreateCutiNormatifRelation extends Migration {

    private $table = '{{%kehadiran_di_internal_sistem}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->addColumn($this->table, 'cuti_normatif_id', $this->integer());
        $this->createIndex('idx_cuti_normatif_di_kehadiran_di_internal_sistem', $this->table, 'cuti_normatif_id');
        $this->addForeignKey('fk_cuti_normatif_di_kehadiran_di_internal_sistem',
            $this->table,
            'cuti_normatif_id',
            'cuti_normatif',
            'id',
            'RESTRICT',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk_cuti_normatif_di_kehadiran_di_internal_sistem', $this->table);
        $this->dropIndex('idx_cuti_normatif_di_kehadiran_di_internal_sistem', $this->table);
        $this->dropColumn($this->table, 'cuti_normatif_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210625_080502_CreateCutiNormatifRelation cannot be reverted.\n";

        return false;
    }
    */
}
