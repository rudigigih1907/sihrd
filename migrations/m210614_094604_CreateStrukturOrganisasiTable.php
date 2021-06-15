<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%struktur_organisasi}}`.
 */
class m210614_094604_CreateStrukturOrganisasiTable extends Migration
{
    private $table = '{{%struktur_organisasi}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%struktur_organisasi}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'tipe' => "ENUM('GROUP', 'PERUSAHAAN', 'CABANG', 'DEPARTEMEN', 'JABATAN') NOT NULL",
            'nama' => $this->string()->notNull(),
            'alias' => $this->string(),
            'kode' => $this->char(100)->notNull()->unique(),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
            'created_by'=> $this->string(10)->null()->defaultValue(null),
            'updated_by'=> $this->string(10)->null()->defaultValue(null),
        ]);

        $this->createIndex('idx_struktur_organisasi_parent' , $this->table, 'parent_id');
        $this->addForeignKey('fk_struktur_organisasi_parent' , $this->table,
            'parent_id',
            $this->table,
            'id',
            "RESTRICT",
            "CASCADE"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk_struktur_organisasi_parent' , $this->table);
        $this->dropIndex('idx_struktur_organisasi_parent' , $this->table);
        $this->dropTable('{{%struktur_organisasi}}');
    }
}
