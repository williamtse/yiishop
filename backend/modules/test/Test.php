<?php
/**
 * 
Plugin Name: Test
Plugin URI: https://Test.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="https://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.1.11
Author: William Tse
Author URI: https://automattic.com/Test-plugins/
License: GPLv2 or later
Text Domain: Test
 * 
 */
namespace backend\modules\test;

/**
 * test module definition class
 */
class Test extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\test\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
