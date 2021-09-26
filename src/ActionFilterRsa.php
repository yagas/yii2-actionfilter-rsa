<?php

namespace yagas\filters;

use Yii;
use yii\base\ActionFilter;
use yii\base\ErrorException;

class ActionFilterRsa extends ActionFilter {

    public $publicKey = '@app/runtime/publicKey.pem';

    public $algorithms = OPENSSL_ALGO_SHA256;

    /** @var InterfaceSign $funHandle */
    public $funHandle;

    /**
     * Rsa Verify
     */
    public function beforeAction($action)
    {
        if ($this->isActive($action)) {
            $publicKey = realpath(Yii::getAlias($this->publicKey));
            if (!is_file($publicKey)) {
                Yii::error(Yii::t('app', 'Not found public key file: '.$publicKey.'.'));
                return false;
            }

            $pk = \openssl_pkey_get_public( 'file://'.$publicKey );
            if (!$pk) {
                Yii::error(Yii::t('app', 'Failed to load the public key file: '.$publicKey.'.'));
                return false;
            }

            if (!($this->funHandle instanceof InterfaceSign)) {
                Yii::error(Yii::t('app', 'Invalid function handle.'));
                return false;
            }

            $SignString = \call_user_func([$this->funHandle, 'toSign'], Yii::$app->request);
            if (!$SignString) {
                Yii::error(Yii::t('app', 'Failed to get toSign string.'));
                return false;
            }

            $sign = \call_user_func([$this->funHandle, 'getSign']);
            if (!$sign) {
                Yii::error(Yii::t('app', 'Failed to get sign string.'));
                return false;
            }

            $state = \openssl_verify($SignString, $sign, $pk, $this->algorithms);
            if ($state !== 1) {
                Yii::error(Yii::t('app', 'Signature validation has failed.'));
                return false;
            }
        }
        
        return true;
    }
}