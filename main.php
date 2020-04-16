<?php
require_once  './vendor/autoload.php';

use Webserver\Application;

$app = new Application($argv);
$app
    ->init()
    ->resolveInputs()
;
$curl = new \Webserver\Curl();
$response = $curl->put($app->getJsonForSend());

print_r($response);
