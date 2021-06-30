<?php

use yii\db\Migration;

/**
 * Class m210629_185315_AlterUserTable
 */
class m210629_185315_AlterUserTable extends Migration
{

    private $table = "{{user}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table,'karyawan_id', $this->integer()->notNull());
        $this->createIndex('idx_karyawan_di_tabel_user', $this->table, 'karyawan_id', true);
        $this->addForeignKey('fk_karyawan_di_tabel_user',
            $this->table,
            'karyawan_id',
            'karyawan',
            'id',
            'SET NULL',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_karyawan_di_tabel_user', $this->table);
        $this->dropIndex('idx_karyawan_di_tabel_user', $this->table);
        $this->dropColumn($this->table,'karyawan_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210629_185315_AlterUserTable cannot be reverted.\n";

        return false;
    }
    */
}
