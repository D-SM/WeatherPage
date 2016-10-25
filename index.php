<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once  __DIR__ . '/vendor/autoload.php';
require_once  __DIR__ . '/const.php';

$app = new \Silex\Application();

$app->register(new \Silex\Provider\TwigServiceProvider(), [
        'twig.path' => __DIR__ . '/view',
]);

$app->get('/', function() use ($app) {
    return 'PHPJSPOZ1 Project';
});

$app->run();