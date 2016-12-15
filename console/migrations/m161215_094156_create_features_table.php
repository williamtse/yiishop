<?php

use yii\db\Migration;

/**
 * 特征量
 * Handles the creation of table `features`.
 */
class m161215_094156_create_features_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('features', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(30),
            'cid' => $this->integer(11),
            'pid' => $this->integer(11),
            'is_color' => $this->boolean(),
            'is_enum' => $this->boolean(),
            'is_input' => $this->boolean(),
            'is_key' => $this->boolean(),
            'is_sale' => $this->boolean(),
            'status' => $this->smallInteger(3),
            'sort_num' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('features');
    }
}
