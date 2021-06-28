<?php

use yii\db\Migration;

/**
 * Class m210628_060212_AlterStrukturOrganisasiTable
 */
class m210628_060212_AlterStrukturOrganisasiTable extends Migration
{

    private $table = '{{%struktur_organisasi}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'singkatan',
            $this->char(50)->after('nama')->notNull()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'singkatan');
    }

}
