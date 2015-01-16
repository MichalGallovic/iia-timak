<?php
use IIA\Auth\Auth as Auth;
// routes
$auth = new Auth($app);

$app->group('/admin', function() use ($app) {
	$app->get('/', function() use ($app) {
		$app->render('admin/index.php', ['app'=>$app]);
	})->name('admin.index');

	$app->group('/rooms', function() use ($app) {
		$app->get('/', function() use ($app) {
			$app->render('admin/rooms/get_all_rooms.php', ['app' => $app]);
		})->name('admin.rooms');
	});

    $app->group('/subjects', function() use ($app) {
        $app->get('/add', function() use ($app) {
           $app->render('admin/subjects/pridat_predmet.php');
        });
    });
});

$app->get('/login', function() use ($app) {
    $app->render('login.php', ['app' => $app]);
})->name('login');

$app->post('/login', function() use ($app) {
    $app->render('authenticate.php', ['app' => $app]);
})->name('auth');

$app->get('/logout', function() use ($app) {
   $app->render('logout.php', ['app' => $app]);
})->name('logout');


// #### FORNYHO SERVICE ####
$app->get('/service/:segments+', function($segments) use ($app) {
    $API = new \IIA\service\MyAPI($segments, $app->config('db'));
    $responseData = $API->processAPI();
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body($responseData);
});