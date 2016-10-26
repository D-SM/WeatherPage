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

/* WIDOK REJESTRACJI */
$app->get('/form-reg', function () use ($app) {   
    return $app['twig']->render('form-reg.twig');
});

/* WIDOK LOGOWANIA */
$app->get('/form-log', function () use ($app) {   
    return $app['twig']->render('form-log.twig');
});

/* WIDOK ZMIANY HASŁA */
$app->get('/change-pass', function () use ($app) {   
    return $app['twig']->render('change-pass.twig');
});

/* WIDOK PANELU UŻYTKOWNIKA */
$app->get('/user-panel', function () use ($app) {   
    return $app['twig']->render('user-panel.twig',[
     
    ]);
});

$app->get('/forgot-pass', function () use ($app) {   
    return $app['twig']->render('forgot-pass.twig');
});

$app->get('/forgot-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {   
  
        return $app['twig']->render('forgot-pass-confirm.twig', [      
        ]);
    
});

$app->post('/form-log', function () use ($app) {   
    
 
    return $app['twig']->render('form-log.twig',[
    ]);
});

$app->post('/form-reg', function () use ($app) {   
    $reg = new User\UserController();
    $reg->renderRegisterPage();
    return $app['twig']->render('form-reg.twig', [
   
    ]);
});

<<<<<<< HEAD
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
=======
$app->post('/change-pass', function () use ($app) {   
    return $app['twig']->render('change-pass.twig', [
       
    ]);
>>>>>>> ca676789acdf696973a67e74706046c25f8dabbf
});

$app->post('/forgot-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {   
         
        return $app->redirect('user-panel');
    
});




$app->run();
