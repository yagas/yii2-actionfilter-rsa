<?php

define('DS', DIRECTORY_SEPARATOR);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';

use Yii;
use yii\base\Action;
use yagas\filters\ActionFilterRsa;

class TestRsaVerifyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        // 初始化构建测试环境
        Yii::setAlias('@app/runtime', dirname(__DIR__) . DS . 'resource');
        // Yii::$container->set('yii\base\Module', ['test-module']);
        // Yii::$container->set('yii\web\Controller', ['id' => 'test-controller']);
        Yii::$container->set('yii\base\Action', 'test-action');
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $components = Yii::createObject([
            'class' => ActionFilterRsa::class
        ]);

        codecept_debug(Yii::$container->get('yii\base\Action'));

        // $components->beforeAction(Yii::$container->get('yii\base\Action'));

        // $publicKey = Yii::getAlias($components->publicKey);
        // if (is_file($publicKey)) {
        //     codecept_debug($publicKey);
        // }        
    }
}