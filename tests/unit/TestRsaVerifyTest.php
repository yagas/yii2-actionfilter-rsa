<?php

define('DS', DIRECTORY_SEPARATOR);

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../resource/MyHandle.php';

use yii\base\Action;
use yii\base\Module;
use yii\console\Controller;
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
        Yii::setAlias('@app/runtime', dirname(__DIR__));
        $controller = new Controller('test', null);
        Yii::$container->set('yii\base\Action', function() use($controller){
            return new Action('test', $controller);
        });
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $components = Yii::createObject([
            'class' => ActionFilterRsa::class,
            'publicKey' => '@app/runtime/resource/publicKey.pem',
            'funHandle' => new MyHandle()
        ]);

        $action = Yii::$container->get('yii\base\Action');
        $components->beforeAction( $action );

        // codecept_debug($components);
    }
}