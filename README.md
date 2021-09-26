RSA ActionFilter
================
RSA Verify Filter

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yagas/yii2-actionfilter-rsa "*"
```

or add

```
"the24/yii2-actionfilter-rsa": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
SiteController extends Controller {
    public function behaviors()
    {
      return [
        'rsa_filter' => [
            'class' => ActionFilterRsa::class,
            'publicKey' => '@app/runtime/resource/publicKey.pem',
            'funHandle' => new MyHandle()
        ]
      ];
    }
}
```
