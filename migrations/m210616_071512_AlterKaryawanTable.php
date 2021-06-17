<?php

use yii\db\Migration;

/**
 * Class m210616_071512_AlterKaryawanTable
 */
class m210616_071512_AlterKaryawanTable extends Migration {

    private $table = "{{karyawan}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn($this->table,'mesin_absensi_password', $this->string());
        $this->addColumn($this->table,'mesin_absensi_rfid', $this->string());
        $this->addColumn($this->table,'mesin_absensi_previlege', $this->string()->defaultValue("User"));
        $this->addColumn($this->table,'mesin_absensi_telapak_tangan', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn($this->table,'mesin_absensi_password');
        $this->dropColumn($this->table,'mesin_absensi_rfid');
        $this->dropColumn($this->table,'mesin_absensi_previlege');
        $this->dropColumn($this->table,'mesin_absensi_telapak_tangan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210616_071512_AlterKaryawanTable cannot be reverted.\n";

        return false;
    }
    */
}
