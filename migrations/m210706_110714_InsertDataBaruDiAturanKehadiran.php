<?php

use yii\db\Migration;

/**
 * Class m210706_110714_InsertDataBaruDiAturanKehadiran
 */
class m210706_110714_InsertDataBaruDiAturanKehadiran extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->insert('aturan_uang_kehadiran', [
            'nama' => 'Default Menerima (Kebijakan Direksi)',
            'keterangan' => "Kebijakan Direksi",
            'is_dapat_uang_kehadiran' => 1,
            'is_aktif' => 1
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->delete('aturan_uang_kehadiran', ['nama' => 'Default Menerima (Kebijakan Direksi)'],);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210706_110714_InsertDataBaruDiAturanKehadiran cannot be reverted.\n";

        return false;
    }
    */
}
