<?php

use yii\db\Migration;

/**
 * Class m210706_091833_AlterKaryawanTable
 */
class m210706_091833_AlterKaryawanTable extends Migration {

    private $table = "{{karyawan}}";


    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->addColumn('karyawan', 'aturan_umum_uang_kehadiran',
            'ENUM("Ikut Aturan Umum", "Yang Penting Masuk Kantor") DEFAULT "Ikut Aturan Umum"'
        );

        $this->addColumn('karyawan', 'batas_jam_terlambat_karena_lembur_pada_hari_berikutnya',
            $this->time()->defaultValue('10:05:00')->after('pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('karyawan', 'batas_jam_terlambat_karena_lembur_pada_hari_berikutnya');
        $this->dropColumn('karyawan', 'aturan_umum_uang_kehadiran');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210706_091833_AlterKaryawanTable cannot be reverted.\n";

        return false;
    }
    */
}
