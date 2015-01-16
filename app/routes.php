<?php
// routes

$app->group('/admin', function() use ($app) {
	$app->get('/', function() use ($app) {
		$app->render('admin/index.php', ['app'=>$app]);
	})->name('admin.index');

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


// #### FORNYHO SERVICE ####
$app->get('/service/:segments+', function($segments) use ($app) {
    $API = new \IIA\service\MyAPI($segments, $app->config('db'));
    $responseData = $API->processAPI();
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body($responseData);
});