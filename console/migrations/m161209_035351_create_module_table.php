<?php

use yii\db\Migration;

/**
 * Handles the creation of table `module`.
 */
class m161209_035351_create_module_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('module', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'actived'=> $this->boolean()->notNull()->defaultValue(0),
            'installed_at'=> $this->integer(11), 
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('module');
    }
}
