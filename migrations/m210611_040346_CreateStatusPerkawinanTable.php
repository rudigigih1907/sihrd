<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_perkawinan}}`.
 */
class m210611_040346_CreateStatusPerkawinanTable extends Migration {

    private $table = '{{%status_perkawinan}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%status_perkawinan}}', [
            'id' => $this->primaryKey(),
            'tipe' => "ENUM( 'TIDAK KAWIN', 'KAWIN', 'PTKP Digabung')",
            'kode' => $this->char(20)->notNull(),
            'nama' => $this->string()->notNull(),
            'keterangan' => $this->text(),
            'created_at' => $this->integer(11)->null()->defaultValue(null),
            'updated_at' => $this->integer(11)->null()->defaultValue(null),
            'created_by' => $this->string(10)->null()->defaultValue(null),
            'updated_by' => $this->string(10)->null()->defaultValue(null),
        ]);

        $this->batchInsert($this->table, [
            'tipe', 'kode', 'nama', 'keterangan'
        ], [
            ['tipe' => 'TIDAK KAWIN', 'kode' => 'TK/0', 'nama' => 'TIDAK KAWIN / TANPA TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'TIDAK KAWIN', 'kode' => 'TK/1', 'nama' => 'TIDAK KAWIN / 1 TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'TIDAK KAWIN', 'kode' => 'TK/2', 'nama' => 'TIDAK KAWIN / 2 TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'TIDAK KAWIN', 'kode' => 'TK/3', 'nama' => 'TIDAK KAWIN / 3 TANGGUNGAN', 'keterangan' => ''],

            ['tipe' => 'KAWIN', 'kode' => 'K/0', 'nama' => 'KAWIN / TANPA TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'KAWIN', 'kode' => 'K/1', 'nama' => 'KAWIN / 1 TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'KAWIN', 'kode' => 'K/2', 'nama' => 'KAWIN / 2 TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'KAWIN', 'kode' => 'K/3', 'nama' => 'KAWIN / 3 TANGGUNGAN', 'keterangan' => ''],

            ['tipe' => 'PTKP Digabung', 'kode' => 'K/I/0', 'nama' => 'PTKP Digabung / TANPA TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'PTKP Digabung', 'kode' => 'K/I/1', 'nama' => 'PTKP Digabung / 1 TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'PTKP Digabung', 'kode' => 'K/I/2', 'nama' => 'PTKP Digabung / 2 TANGGUNGAN', 'keterangan' => ''],
            ['tipe' => 'PTKP Digabung', 'kode' => 'K/I/3', 'nama' => 'PTKP Digabung / 3 TANGGUNGAN', 'keterangan' => ''],
        ]);

        $this->addForeignKey("fk_status_perkawinan_karyawan", 'karyawan', 'status_perkawinan_id',
            $this->table,
            'id',
            'RESTRICT',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {

        $this->dropForeignKey("fk_status_perkawinan_karyawan", 'karyawan');
        $this->dropTable('{{%status_perkawinan}}');
    }
}
