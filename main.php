<?php
require_once  './vendor/autoload.php';

use Webserver\Application;
use Webserver\Config\Config;

$app = new Application($argv);
$app->init();
$url = Config::$base_url . Config::$url;
$curl = new \Webserver\Curl($url);
$response = $curl->put($app->getJsonForSend());

print_r($response);
