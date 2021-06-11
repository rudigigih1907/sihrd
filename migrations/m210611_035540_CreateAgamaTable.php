<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%agama}}`.
 */
class m210611_035540_CreateAgamaTable extends Migration
{

    private $table = '{{%agama}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%agama}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'alias' => $this->char(50)->unique()->notNull(),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
            'created_by'=> $this->string(10)->null()->defaultValue(null),
            'updated_by'=> $this->string(10)->null()->defaultValue(null),
        ]);

        $this->batchInsert($this->table,[
            'nama',
            'alias'
        ], [
            ['nama' => 'Islam', 'alias' => 'islam'],
            ['nama' => 'Protestan', 'alias' => 'protestan'],
            ['nama' => 'Katolik', 'alias' => 'katolik'],
            ['nama' => 'Hindu', 'alias' => 'hindu'],
            ['nama' => 'Buddha', 'alias' => 'buddha'],
            ['nama' => 'Khonghucu', 'alias' => 'khonghucu'],
        ]);

        $this->addForeignKey("fk_agama_karyawan", 'karyawan', 'agama_id',
            'agama',
            'id',
            'RESTRICT',
            'CASCADE'
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey("fk_agama_karyawan", 'karyawan');
        $this->dropTable('{{%agama}}');
    }
}
