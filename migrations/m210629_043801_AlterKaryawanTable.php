<?php

use yii\db\Migration;

/**
 * Class m210629_043801_AlterKaryawanTable
 */
class m210629_043801_AlterKaryawanTable extends Migration
{

    private $table = "{{karyawan}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'photo_identitas_diri', $this->text()->after('jadwal_kerja_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210629_043801_AlterKaryawanTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210629_043801_AlterKaryawanTable cannot be reverted.\n";

        return false;
    }
    */
}
