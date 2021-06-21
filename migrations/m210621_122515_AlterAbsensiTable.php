<?php

use yii\db\Migration;

/**
 * Class m210621_122515_AlterAbsensiTable
 */
class m210621_122515_AlterAbsensiTable extends Migration
{

    private $table = "{{absensi}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn($this->table, 'file', $this->string()->notNull());
        $this->addColumn($this->table,'created_at', $this->integer(11)->null()->defaultValue(null));
        $this->addColumn($this->table,'updated_at', $this->string(10)->null()->defaultValue(null));
        $this->addColumn($this->table,'created_by', $this->integer(11)->null()->defaultValue(null));
        $this->addColumn($this->table,'updated_by', $this->string(10)->null()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'file');
        $this->dropColumn($this->table,'created_at');
        $this->dropColumn($this->table,'updated_at');
        $this->dropColumn($this->table,'created_by');
        $this->dropColumn($this->table,'updated_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210621_122515_AlterAbsensiTable cannot be reverted.\n";

        return false;
    }
    */
}
