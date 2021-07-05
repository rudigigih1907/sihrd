<?php

use yii\db\Migration;

/**
 * Class m210705_094243_AlterKaryawanPtkpTable
 */
class m210705_094243_AlterKaryawanPtkpTable extends Migration
{

    private $table = '{{%karyawan_ptkp}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'keterangan' ,  $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'keterangan');


    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210705_094243_AlterKaryawanPtkpTable cannot be reverted.\n";

        return false;
    }
    */
}
