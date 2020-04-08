<?php
include './vendor/autoload.php';

use Webserver\Application;
use WebServer\Curl;
use Webserver\Config\Config;


$app = new Application($argv);

echo $app->init();
$url = Config::$base_url.'/'.Config::$url;
$curl = new Curl($url);
$response = $curl->put($app->getJsonForSend);

print_r($response);
