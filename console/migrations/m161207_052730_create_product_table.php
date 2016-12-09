<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m161207_052730_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'detial' => $this->text()->notNull(),
            'price' => $this->float()->notNull()->defaultValue(0.00),
            'cid' => $this->smallInteger(),#分类
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
