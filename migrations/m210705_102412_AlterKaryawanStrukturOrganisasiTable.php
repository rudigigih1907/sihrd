<?php

use yii\db\Migration;

/**
 * Class m210705_102412_AlterKaryawanStrukturOrganisasiTable
 */
class m210705_102412_AlterKaryawanStrukturOrganisasiTable extends Migration
{

    private $table = "{{karyawan_struktur_organisasi}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'nomor_surat_pengangkatan', $this->string()->null());
        $this->alterColumn($this->table, 'tanggal_aktif', $this->date()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table, 'tanggal_aktif', $this->date()->notNull());
        $this->alterColumn($this->table, 'nomor_surat_pengangkatan', $this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210705_102412_AlterKaryawanStrukturOrganisasiTable cannot be reverted.\n";

        return false;
    }
    */
}
