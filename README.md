Yii2-Datepicker
========

[Daterangepicker](http://www.daterangepicker.com/) gives you a customizable daterangepicker with support for multidate, time, localization and many other highly used options.

##Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require pcrt/yii2-notify "*"
```

or add

```
"pcrt/yii2-notify": "*"
```

to the require section of your `composer.json` file.

## Usage

Once the extension is installed, modify your application configuration to include:

```php

'components' => [
    'notification' => [
      'class' => 'pcrt\component\Notification',
      'mainpath' => '/mail/template/',
      'overridepath' => '/mail/override/',
      'notifier_email' => 'info@protocollicreativi.it'
    ],
    ....
    ....
  ]
```

If you want to log information relative to message sent can add a specific rules to log config

```php

'log' => [
    'targets' => [
        [
            'class' => 'yii\log\FileTarget',
            'levels' => ['info', 'error', 'warning'],
            'categories' => ['notification'],
            'logVars' => [],
            'logFile' => '@runtime/logs/notification.log',
        ],
        ...
        ...
    ],
],
```
Now you can use the component inside your action or view 

```php

  Yii::$app->notification->send('test', [], 'info@protocollicreativi.it', 'test');

```

The first params is template name, the library find the template in ovveride path, then in the main path and mathc the first .

The second params is an array passed to mail template as params .

The third params is the destination email address .

The fourth params is the mail subject .




## License

Yii2-Datepicker is released under the BSD-3 License. See the bundled `LICENSE.md` for details.

Enjoy!
