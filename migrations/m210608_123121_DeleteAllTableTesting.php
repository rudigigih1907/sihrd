<?php

use yii\db\Migration;

/**
 * Class m210608_123121_DeleteAllTableTesting
 */
class
m210608_123121_DeleteAllTableTesting extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable("card");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210608_123121_DeleteAllTableTesting cannot be reverted.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210608_123121_DeleteAllTableTesting cannot be reverted.\n";

        return false;
    }
    */
}
