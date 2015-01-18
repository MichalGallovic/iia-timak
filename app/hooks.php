<?php
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);

$app->hook('before.admin', function () use ($app,$auth) {
    if(!$auth->check()) {
        $app->redirect('/login');
    }
});