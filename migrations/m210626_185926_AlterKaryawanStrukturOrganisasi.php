<?php

use yii\db\Migration;

/**
 * Class m210626_185926_AlterKaryawanStrukturOrganisasi
 */
class m210626_185926_AlterKaryawanStrukturOrganisasi extends Migration
{

    private $table = "{{karyawan_struktur_organisasi}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'karyawan_id',  $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210626_185926_AlterKaryawanStrukturOrganisasi cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210626_185926_AlterKaryawanStrukturOrganisasi cannot be reverted.\n";

        return false;
    }
    */
}
