<?php

use yii\db\Migration;

/**
 * Class m210629_105150_AlterKaryawanTable
 */
class m210629_105150_AlterKaryawanTable extends Migration
{

    private $table = "{{karyawan}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table,'pendidikan_terakhir',"ENUM('SD','SMP','SMA','D3', 'S1','S2','S3') DEFAULT NULL");
        $this->alterColumn($this->table,'status_perkawinan_id',$this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table,'pendidikan_terakhir',"ENUM('SD','SMP','SMA','S1','S2','S3') DEFAULT NULL");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210629_105150_AlterKaryawanTable cannot be reverted.\n";

        return false;
    }
    */
}
