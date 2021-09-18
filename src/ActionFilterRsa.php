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
            $pk = \openssl_pkey_get_public( Yii::getAlias($this->publicKey) );
            if (!$pk) {
                throw new ErrorException(Yii::t('app', 'Failed to load the public key file.'));
            }

            $SignString = \call_user_func([$this->funHandle, 'Sign'], Yii::$app->request);
            if (!$SignString) {
                throw new ErrorException(Yii::t('app', 'Failed to get sign string.'));
            }

            $state = \openssl_verify($SignString, $sign, $pk, $this->algorithms);
            if ($state !== 1) {
                throw new ErrorException(Yii::t('Signature validation has failed'));
            }
        }
        
        return true;
    }
}