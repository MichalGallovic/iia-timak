<?php
use IIA\Auth\Auth as Auth;
// routes
$auth = new Auth($app);

$app->group('/admin', function() use ($app) {
	$app->get('/', function() use ($app) {
		$app->render('admin/index.php', ['app'=>$app]);
	})->name('admin.index');

// //$app->group('/admin', function() use ($app) {
//     $app->get('/', function() use ($app) {
//         $app->render('admin/kontrola.php', ['app'=>$app]);
//     })->name('admin.kontrola');


	$app->group('/rooms', function() use ($app) {
		
        $app->get('/', function() use ($app) {
			$app->render('admin/rooms/get_all_rooms.php', ['app' => $app]);
		})->name('admin.rooms');

        $app->get('/create', function() use ($app) {
            $app->render('admin/rooms/create_room.php', ['app' => $app]);
        })->name('admin.rooms.create');

        $app->post('/create', function() use ($app) {
            $app->render('admin/rooms/store_room.php', ['app' => $app]);
        })->name('admin.rooms.store');

        $app->get('/delete', function() use ($app) {
            $app->render('admin/rooms/delete_room.php', ['app' => $app]);
        })->name('admin.rooms.delete');

        $app->post('/delete', function() use ($app) {
            $app->render('admin/rooms/remove_room.php', ['app' => $app]);
        })->name('admin.rooms.remove');


        $app->get('/edit', function() use ($app) {
            $app->render('admin/rooms/edit_room.php', ['app' => $app]);
        })->name('admin.rooms.edit');

        $app->post('/edit', function() use ($app) {
            $app->render('admin/rooms/update_room.php', ['app' => $app]);
        })->name('admin.rooms.update');

	});

    $app->group('/subjects', function() use ($app) {

        $app->get('/', function() use ($app) {
            $app->render('admin/subjects/get_all_subjects.php', ['app' => $app]);
        })->name('admin.subjects');

        $app->get('/add', function() use ($app) {
           $app->render('admin/subjects/pridat_predmet.php');
        });
        $app->get('/kontrola', function() use ($app) {
           $app->render('admin/subjects/kontrola.php');
        });

        $app->get('/create', function() use ($app) {
            $app->render('admin/subjects/create_subject.php', ['app' => $app]);
        })->name('admin.subjects.create');

        $app->post('/store', function() use ($app) {
            $app->render('admin/subjects/store_subject.php', ['app' => $app]);
        })->name('admin.subjects.store');

         $app->get('/edit', function() use ($app) {
            $app->render('admin/subjects/edit_subject.php', ['app' => $app]);
        })->name('admin.subjects.edit');

        $app->post('/update', function() use ($app) {
            $app->render('admin/subjects/update_subject.php', ['app' => $app]);
        })->name('admin.subjects.update');




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