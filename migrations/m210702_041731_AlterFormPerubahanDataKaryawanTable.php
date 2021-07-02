<?php

use yii\db\Migration;

/**
 * Class m210702_041731_AlterFormPerubahanDataKaryawanTable
 */
class m210702_041731_AlterFormPerubahanDataKaryawanTable extends Migration {

    private $table = '{{%form_perubahan_data_karyawan}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn($this->table, 'nomor_referensi', $this->string()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        echo "m210702_041731_AlterFormPerubahanDataKaryawanTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210702_041731_AlterFormPerubahanDataKaryawanTable cannot be reverted.\n";

        return false;
    }
    */
}
