<?php
namespace backend\models;
use yii\db\ActiveRecord;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Module extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module';
    }
    
    public static function getModules()
    {
        
    }
}