<?php

namespace common\models;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $created_at
 * @property integer $updated_at
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['pid', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pid' => 'Pid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['cid' => 'id']);
    } 
    
    public static function toTree($cates)
    {
        $tree = array();
        foreach($cates as $c)
        {
            if($c['pid']==0)
            {
                $tree[$c['id']] = $c;
            }
        }
        foreach($cates as $c)
        {
            if($c['pid']>0)
            {
                if(!isset($tree[$c['pid']]['sub']))
                {
                    $tree[$c['pid']]['sub'] = array();
                }
                $tree[$c['pid']]['sub'][]= $c;
            }
        }
        return $tree;
    }
}
