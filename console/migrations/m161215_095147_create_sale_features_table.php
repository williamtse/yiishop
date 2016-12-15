<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sale_features`.
 */
class m161215_095147_create_sale_features_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sale_features', [
            'id' => $this->primaryKey(),
            'feature_value_id' => $this->integer(11),
            'feature_id' => $this->integer(11),
            'feature_val' => $this->string(),
            'image_path' => $this->string(),
            'extend_value'=> $this->string(),
            'pid'=> $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sale_features');
    }
}
