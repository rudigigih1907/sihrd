<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ketegori_izin}}`.
 */
class m210623_063143_CreateKetegoriIzinTable extends Migration {

    private $table = '{{%kategori_izin}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->createTable('{{%kategori_izin}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
        ]);

        $this->createTable('{{%jenis_izin}}', [
            'id' => $this->primaryKey(),
            'kategori_izin_id' => $this->integer(),
            'nama' => $this->string()->notNull(),
        ]);

        $this->createIndex("idx_jenis_di_kategori_izin", '{{%jenis_izin}}',
            "kategori_izin_id"
        );
        $this->addForeignKey("fk_jenis_di_kategori_izin", '{{%jenis_izin}}',
            "kategori_izin_id",
            "kategori_izin",
            "id",
            "CASCADE",
            "CASCADE"
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey("fk_jenis_di_kategori_izin", '{{%jenis_izin}}');
        $this->dropIndex("idx_jenis_di_kategori_izin", '{{%jenis_izin}}');
        $this->dropTable('{{%jenis_izin}}');
        $this->dropTable('{{%kategori_izin}}');
    }
}
