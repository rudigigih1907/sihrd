<?php

use yii\db\Migration;

/**
 * Class m210622_170315_AlterKaryawanPtkpTable
 */
class m210622_170315_AlterKaryawanPtkpTable extends Migration
{

    private $table = '{{%karyawan_ptkp}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'batal_ptkp_id', $this->integer()->null()->comment('Alasan Tidak Terhitung'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table, 'batal_ptkp_id', $this->integer()->notNull()->comment('Alasan Tidak Terhitung'));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210622_170315_AlterKaryawanPtkpTable cannot be reverted.\n";

        return false;
    }
    */
}
