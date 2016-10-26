<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once  __DIR__ . '/vendor/autoload.php';
require_once  __DIR__ . '/const.php';

$app = new \Silex\Application();

use App\MainController;
use App\SearchController;

$app->register(new \Silex\Provider\TwigServiceProvider(), [
        'twig.path' => __DIR__ . '/view',
]);

$app['twig']->addGlobal('webPath', WEB_PATH);

$app->get('/', function() use ($app) {
    $controller = new MainController($app['twig']);
    return $controller->renderPage();
});

$app->get('/search', function() use ($app) {
    $controller = new SearchController($app['twig']);
    return $controller->renderPage();
});

$app->get('/profile', function() use ($app) {
    $controller = new SearchController($app['twig']);
    return $controller->renderPage();
});

$app->run();