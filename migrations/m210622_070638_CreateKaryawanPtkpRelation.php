<?php

use yii\db\Migration;

/**
 * Class m210622_070638_CreateKaryawanPtkpRelation
 */
class m210622_070638_CreateKaryawanPtkpRelation extends Migration
{

    private $table = '{{%karyawan_ptkp}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx_ptkp_karyawan',$this->table, 'karyawan_id');
        $this->createIndex('idx_hubungan_ptkp_karyawan',$this->table, 'hubungan_ptkp_id');
        $this->createIndex('idx_batal_ptkp_karyawan',$this->table, 'batal_ptkp_id');

        $this->addForeignKey('fk_ptkp_karyawan',$this->table, 'karyawan_id',
            'karyawan',
            'id',
            'CASCADE',
            'CASCADE'
            );

        $this->addForeignKey('fk_hubungan_ptkp_karyawan',$this->table, 'hubungan_ptkp_id',
            'hubungan_ptkp',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey('fk_batal_ptkp_karyawan',$this->table, 'batal_ptkp_id',
            'batal_ptkp',
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

        $this->dropForeignKey('fk_ptkp_karyawan',$this->table);
        $this->dropForeignKey('fk_hubungan_ptkp_karyawan',$this->table);
        $this->dropForeignKey('fk_batal_ptkp_karyawan',$this->table);

        $this->dropIndex('idx_ptkp_karyawan',$this->table);
        $this->dropIndex('idx_hubungan_ptkp_karyawan',$this->table);
        $this->dropIndex('idx_batal_ptkp_karyawan',$this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210622_070638_CreateKaryawanPtkpRelation cannot be reverted.\n";

        return false;
    }
    */
}
