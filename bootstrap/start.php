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
    'db'    =>  $configFile
);

class i18nSlim extends \Slim\Slim {
    public function urlFor($name, $params = array(), $lang = null){
        $lang = $lang ? $lang : $this->config('lang');
        $params['lang'] = $lang;
        return parent::urlFor($name, $params);
    }
}
$LANGS = array('','en','sk');
$DEFAULT_LANG = 'sk';

// vytvorenie instancie slim frameworku
$app = new i18nSlim($config['app']);

$lang = substr($app->request()->getResourceUri(), 1, 2);

if(!in_array($lang,['en','sk'])) {
    $lang = $DEFAULT_LANG;
} else {
    $lang = in_array($lang,$LANGS) ? $lang : $DEFAULT_LANG;
}
$app->config('lang', $lang);

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