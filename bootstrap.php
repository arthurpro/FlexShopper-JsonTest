<?php
/**
 * Created by PhpStorm.
 * User: art
 * Date: 12/10/14
 * Time: 6:03 PM
 */

define('DS', '/');
define('ROOT_DIR', dirname(__FILE__));

require ROOT_DIR . DS . 'vendor/autoload.php';

spl_autoload_register(function ($class) {
    $class = explode('_', $class);
    $class = array_map('ucfirst', $class);
    $class = implode(DS, $class);
    if (strpos($class, 'Controller') > 0) {
        include ROOT_DIR . DS . 'controllers' . DS . $class . '.php';
    } else {
        include ROOT_DIR . DS . 'models' . DS . $class . '.php';
    }
});

$app = new \Slim\Slim(array(
    //'mode' => 'development',
    'mode' => 'production',
    'templates.path' => ROOT_DIR . DS . 'templates'
));

$app->setName('JsonTest');

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});

//session_cache_limiter(false);
//session_name($app->getName());
//session_start();