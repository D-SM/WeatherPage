<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/const.php';

$Session = new User\Model\Session();
$app = new \Silex\Application();

use App\MainController;
use App\SearchController;
use App\ProfileController;

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
    return $app['twig']->render('form-log.twig', [
                'path' => WEB_PATH
    ]);
});

/* WIDOK ZMIANY HASŁA */
$app->get('/change-pass', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('change-pass.twig');
});

/* WIDOK PANELU UŻYTKOWNIKA */
$app->get('/user-panel', function () use ($app ) {
    //diabelek: brak controlera
    return $app['twig']->render('user-panel.twig', [
        'email' => User\Model\Session::getName()
    ]);
});

$app->get('/reset-pass', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('forgot-pass.twig');
});

$app->get('/reset-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('forgot-pass-confirm.twig', []);
});

$app->post('/login', function () use ($app ) {
    //diabelek: brak controlera
    $reg = new User\UserController();
    $reg->renderLoginPage();
    

    if ($reg->renderLoginPage()) {

        return $app->redirect('user-panel');
    } else {
        return $app['twig']->render('form-log.twig', [
                    'errors' => $reg->getInputErrors(),
        ]);
    }
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
    return $controller->renderPage(1);
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

$app->post('/reset-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {
    return $app->redirect('user-panel');
});
$app->post('/reset-pass', function () use ($app) {
     $reg = new User\UserController();
     $reg->renderRememberPasswordPage();
   return $app['twig']->render('forgot-pass-confirm.twig');
});

$app->get('/apitest', function() use ($app) {
    $apiModel = new \WeatherAPI\Model\Current();
//    echo '<pre>';
//    var_dump($apiModel->getWeather('Poznan'));
//    return $app->json($apiModel->getWeather('Poznan'));
    var_dump($apiModel->getWeatherByCityName('Poznan'));

//    return var_dump($apiModel->getForecast('Poznan'));
});

$app->get('test/', function() use ($app) {
    $apiModel = new \WeatherAPI\Model\Current();
    echo '<pre>';
//    var_dump($apiModel->getWeather('Poznan'));
//    var_dump($apiModel->getForecast('Poznan'));
  
//    $CurrentController = new \WeatherAPI\CurrentController('Poznan');
//    var_dump($CurrentController->getWeeklyAverages('Poznan'));
//    return var_dump($apiModel->getForecast('Poznan'));
});

$app->post('/apigeo', function() use ($app) {
    
    return \WeatherAPI\GeolocController::getWeatherByCoordinates();
    
});

$app->get('/apigeo', function() use ($app) {
    ?>
    <script
       accesskey="" src="https://code.jquery.com/jquery-3.1.1.min.js"
       integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
       crossorigin="anonymous"></script>
    <script src='js/main.js'></script>
    <?php
    return '';
});

$app->run();