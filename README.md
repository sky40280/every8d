# Every8d Client

[![StyleCI](https://styleci.io/repos/83760327/shield?style=flat)](https://styleci.io/repos/83760327)
[![Build Status](https://travis-ci.org/recca0120/every8d.svg)](https://travis-ci.org/recca0120/every8d)
[![Total Downloads](https://poser.pugx.org/recca0120/every8d/d/total.svg)](https://packagist.org/packages/recca0120/every8d)
[![Latest Stable Version](https://poser.pugx.org/recca0120/every8d/v/stable.svg)](https://packagist.org/packages/recca0120/every8d)
[![Latest Unstable Version](https://poser.pugx.org/recca0120/every8d/v/unstable.svg)](https://packagist.org/packages/recca0120/every8d)
[![License](https://poser.pugx.org/recca0120/every8d/license.svg)](https://packagist.org/packages/recca0120/every8d)
[![Monthly Downloads](https://poser.pugx.org/recca0120/every8d/d/monthly)](https://packagist.org/packages/recca0120/every8d)
[![Daily Downloads](https://poser.pugx.org/recca0120/every8d/d/daily)](https://packagist.org/packages/recca0120/every8d)

## Install

```bash
composer require recca0120/every8d php-http/guzzle6-adapter
```

## How to use

```php
require __DIR__.'/vendor/autoload.php';

use Recca0120\Every8d\Client;

$client = new Client([
    'uid' => 'xxx',
    'password' => 'xxx'
]);

$client->credit(); // 取得額度
$client->send([
    'to' => '09xxxxxxxx',
    'text' => 'test message',
]);
```

### TODO

Laravel Notification
