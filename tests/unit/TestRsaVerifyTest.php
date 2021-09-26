<?php

define('DS', DIRECTORY_SEPARATOR);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../resource/MyHandle.php';

use yii\base\Action;
use yii\base\Module;
use yii\console\Controller;
use yii\console\Request;
use yagas\filters\ActionFilterRsa;
use yii\console\Application;

class TestRsaVerifyTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        // 初始化构建测试环境
        Yii::setAlias('@app/runtime', dirname(__DIR__));
        $controller = new Controller('test', null);
        Yii::$container->set('yii\base\Action', function() use($controller){
            return new Action('test', $controller);
        });

        $app = new Application([
            'id' => 'test',
            'basePath' => dirname(__DIR__)
        ]);
        
        Yii::$app->request->setParams([
            'a' => 123,
            'b' => 456
        ]);
    
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->setName('beforeAction');

        $components = Yii::createObject([
            'class' => ActionFilterRsa::class,
            'publicKey' => '@app/runtime/resource/publicKey.pem',
            'funHandle' => new MyHandle()
        ]);

        $action = Yii::$container->get('yii\base\Action');
        $this->assertTrue($components->beforeAction( $action ), "sign string \"123456\" is True");
        
    }

    // tests
    public function testSomeFeature1()
    {
        $this->setName('beforeAction2');

        $components = Yii::createObject([
            'class' => ActionFilterRsa::class,
            'publicKey' => '@app/runtime/resource/publicKey.pem',
            'funHandle' => new MyHandle()
        ]);

        $action = Yii::$container->get('yii\base\Action');
        $this->assertFalse($components->beforeAction( $action ), "sign string \"123456\" is False");
        
    }
}