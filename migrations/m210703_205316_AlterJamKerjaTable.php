<?php

use yii\db\Migration;

/**
 * Class m210703_205316_AlterJamKerjaTable
 */
class m210703_205316_AlterJamKerjaTable extends Migration
{

    const TABLE  = "{{jam_kerja}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'pindah_hari', $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'pindah_hari');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210703_205316_AlterJamKerjaTable cannot be reverted.\n";

        return false;
    }
    */
}
