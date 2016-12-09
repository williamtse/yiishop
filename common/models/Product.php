<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property string $detial
 * @property double $price
 * @property integer $cid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'detial', 'created_at', 'updated_at'], 'required'],
            [['detial'], 'string'],
            [['price'], 'number'],
            [['cid', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'detial' => 'Detial',
            'price' => 'Price',
            'cid' => 'Cid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
   
}
