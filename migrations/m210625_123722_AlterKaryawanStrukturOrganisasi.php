<?php

use yii\db\Migration;

/**
 * Class m210625_123722_AlterKaryawanStrukturOrganisasi
 */
class m210625_123722_AlterKaryawanStrukturOrganisasi extends Migration {

    private $table = "{{karyawan_struktur_organisasi}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn($this->table, 'jenis_jabatan', "ENUM('Utama', 'Pejabat Sementara' , 'Di-perbantukan') NULL AFTER `struktur_organisasi_id` ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn($this->table, 'jenis_jabatan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210625_123722_AlterKaryawanStrukturOrganisasi cannot be reverted.\n";

        return false;
    }
    */
}
