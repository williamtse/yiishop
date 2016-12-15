<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feature_values`.
 */
class m161215_094850_create_feature_values_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feature_values', [
            'id' => $this->primaryKey(),
            'feature_id' => $this->integer(11),
            'feature_val' => $this->string(),
            'status' => $this->smallInteger(3),
            'sort_num' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feature_values');
    }
}
