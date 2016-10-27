<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/const.php';

$app = new \Silex\Application();

use App\MainController;
use App\SearchController;

$app->register(new \Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/view',
]);

$app['twig']->addGlobal('webPath', WEB_PATH);

/* WIDOK REJESTRACJI */
//diabelek: kiepska nazwa rutingu = dlaczego nie register?
$app->get('/register', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('form-reg.twig');
});

/* WIDOK LOGOWANIA */
//diabelek: kiepska nazwa rutingu = dlaczego nie login?
$app->get('/login', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('form-log.twig');
});

/* WIDOK ZMIANY HASŁA */
$app->get('/change-pass', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('change-pass.twig');
});

/* WIDOK PANELU UŻYTKOWNIKA */
$app->get('/user-panel', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('user-panel.twig',[]);
});

$app->get('/reset-pass', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('forgot-pass.twig');
});

$app->get('/reset-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('forgot-pass-confirm.twig', []);
});

$app->post('/login', function () use ($app) {
    //diabelek: brak controlera
     $reg = new User\UserController();
     $reg->renderLoginPage();
    return $app['twig']->render('form-log.twig',[
      'errors' => $reg->getInputErrors()  
    ]);
});

$app->post('/register', function () use ($app) {   
    $reg = new User\UserController();
    $reg->renderRegisterPage();
    return $app['twig']->render('form-reg.twig', [
        'errors' => $reg->getInputErrors()
    ]);
});

$app->get('/', function() use ($app) {
    $controller = new MainController($app['twig']);
    return $controller->renderPage();
});

/* STRONA WYNIkU WYSZUKIWANIA */
$app->get('/search', function() use ($app) {
    $controller = new SearchController($app['twig']);
    return $controller->renderPage();
});

/* STRONA PROFILU */
$app->get('/profile', function() use ($app) {
    $controller = new ProfileController($app['twig']);
    return $controller->renderPage();
});

$app->post('/change-pass', function () use ($app) {  
    //diabelek: brak controlera
    return $app['twig']->render('change-pass.twig', []);
});

$app->post('/reset-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {            
    return $app->redirect('user-panel');
});

$app->get('/apitest', function() use ($app) {
    $apiModel = new \WeatherAPI\Model\Current();
//    echo '<pre>';
//    var_dump($apiModel->getWeather('Poznan'));
    return $app->json($apiModel->getWeather('Poznan'));
//    return var_dump($apiModel->getForecast('Poznan'));
});

$app->get('test/', function() use ($app) {
    $apiModel = new \WeatherAPI\Model\Current();
    echo '<pre>';
    return var_dump($apiModel->getWeather('Poznan'));
});

$app->run();
