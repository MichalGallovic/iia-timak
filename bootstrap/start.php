<?php
// nacitanie prostredia development/production
$_ENV['SLIM_MODE'] = getenv('environment');
session_cache_limiter(false);
session_start();

// nacitanie configu pre slim framework
$config = array();
// Basic config for Slim Application

// nacitanie vlastneho configu suboru - db
$configFile = dirname(__FILE__) . '/../share/config/' . $_ENV['SLIM_MODE'] . '/database.php';

if (is_readable($configFile)) {
    $configFile = require_once $configFile;
}

$config['app'] = array(
    'name' => 'FEI Stuba Rozvrhy',
    'log.enabled' => true,
    'log.level' => Slim\Log::INFO,
//    'log.writer' => new \Slim\LogWriter(array(
//        'path' => dirname(__FILE__) . '/../share/logs'
//    )),
    'mode' => (!empty($_ENV['environment'])) ? $_ENV['SLIM_MODE']: 'production',
    'templates.path'    =>  '../app/templates',
    'db'    =>  $configFile,
    'locale'    =>  'sk_SK'
);

// vytvorenie instancie slim frameworku
$app = new Slim\Slim($config['app']);

// ak sme v mode production
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'log.level' => Slim\Log::WARN,
        'debug' => true
    ));
});

// ak sme v mode development
$app->configureMode('development', function () use ($app, $configFile) {
    $app->config(array(
        'log.enable' => true,
        'log.level' => Slim\Log::DEBUG,
        'debug' => true
    ));
});

return $app;