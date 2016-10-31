<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if (isset($_SESSION['name'])) {
$app['twig']->addGlobal('userName', \User\Model\Session::getName());
}

/* WIDOK REJESTRACJI */
//diabelek: kiepska nazwa rutingu = dlaczego nie register?
$app->get('/register', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('user/register.twig');
});

/* WIDOK LOGOWANIA */

$app->get('/login', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('user/login.twig', [
                'path' => WEB_PATH
    ]);
});

/* WIDOK ZMIANY HASŁA */
$app->get('/change-pass', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('user/change-pass.twig');
});

$app->post('/change-pass', function () use ($app) {
    //diabelek: brak controlera
    $changePass = new User\UserController();
    $changePass->changePassword();
    return $app->redirect('user-panel');
});

/* WIDOK PANELU UŻYTKOWNIKA */
$app->get('/user-panel', function () use ($app ) {
    if ($_SESSION) {
//        $id = new \User\Model\Session();
//        $id->getId();
        $id = new \User\Model\User();
        $email = User\Model\Session::getName();
        $test = $id->getID($email);
        
        
        return $app['twig']->render('user/user-panel.twig', [
                    'email' => User\Model\Session::getName(),
                    'id'  =>  User\Model\Session::getId()
        ]);
    } else {
        return $app->redirect('/phpjspoz1/login');
    }
});
$app->post('/user-panel', function () use ($app ) {
    if ($_POST['name']) {

        $img = new User\helper\Image($inputImage);
    } else {
        session_unset();
        return $app->redirect('/phpjspoz1/login');
    }
});

$app->get('/remind-pass', function () use ($app) {
    //diabelek: brak controlera
    return $app['twig']->render('user/remind-pass.twig');
});
$app->post('/reset-passs', function () use ($app) {
    $resetPass = new User\UserController();
    $resetPass->resetPassword();
    return $app->redirect('login');
});

$app->get('/reset-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {
    $resetPasswordConfirmation = new User\UserController();

    if ($resetPasswordConfirmation->validateInputs($email, $hash)) {

        return $app['twig']->render('user/reset-pass.twig');
    }
    return $app['twig']->render('error.twig');
});


$app->post('/login', function () use ($app ) {
    //diabelek: brak controlera
    $reg = new User\UserController();
    $reg->renderLoginPage();

    if ($reg->renderLoginPage()) {

        return $app->redirect('user-panel');
    } else {
        return $app['twig']->render('user/login.twig', [
                    'errors' => $reg->getInputErrors(),
        ]);
    }
});

$app->post('/register', function () use ($app) {
    $reg = new User\UserController();
    $reg->renderRegisterPage();
    return $app['twig']->render('user/register.twig', [
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
    return $controller->renderPage($app);
});
$app->post('/profile', function() use ($app) {
    $controller = new ProfileController($app['twig']);
    return $controller->renderPage($app);
});

$app->post('/reset-pass-confirm/{email}/{hash}', function ($email, $hash) use ($app) {
    $session = new User\Model\Session();
    User\Model\Session::saveName($email);
    $resetPass = new User\UserController();
    $resetPass->resetPassword();
    $cleanHash = new User\Model\User();
    $cleanHash->removeHash($email);
    return $app->redirect('/phpjspoz1/login');
});
$app->post('/remind-pass', function () use ($app) {
    $reg = new User\UserController();
    $reg->renderRememberPasswordPage();
    return $app['twig']->render('user/send-mail.twig');
});

$app->get('/apitest', function() use ($app) {
    $apiModel = new \WeatherAPI\Model\CurrentWeather();
//    echo '<pre>';
//    var_dump($apiModel->getCurrentWeather('Poznan'));
//    return $app->json($apiModel->getCurrentWeather('Poznan'));
    var_dump($apiModel->getCurrentWeatherByCityName('Poznan'));

//    return var_dump($apiModel->getForecast('Poznan'));
});

$app->get('test/', function() use ($app) {
    $apiModel = new \WeatherAPI\Model\CurrentWeather();
    echo '<pre>';
//    var_dump($apiModel->getCurrentWeather('Poznan'));
//    var_dump($apiModel->getForecast('Poznan'));
//    $CurrentController = new \WeatherAPI\CurrentController('Poznan');
//    var_dump($CurrentController->getWeeklyAverages('Poznan'));
//    return var_dump($apiModel->getForecast('Poznan'));
});

$app->get('/apigeo', function() use ($app) {
    ?>
    <!--    <script
           accesskey="" src="https://code.jquery.com/jquery-3.1.1.min.js"
           integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
           crossorigin="anonymous"></script>
    <?php
    return '';
});

$app->post('/apigeo', function() use ($app) {


    $location = \WeatherAPI\GeolocController::getWeatherByCoordinates();
    return $app['twig']->render('geolocation.twig', [
                'location' => $location
    ]);
});

$app->run();
