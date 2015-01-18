<?php
use IIA\Auth\Auth as Auth;
// routes
$authenticateForRole = function($role = 'guest') use ($app) {
    return function() use ($role,$app) {
        $auth = new Auth($app);
        $roles = ['admin','teacher'];
        if($auth->check()) {
//            if($auth->getUserRole() == $role) {
//
//            } else {
//                $app->redirect($a)
//            }
        } else {
            $app->redirect($app->urlFor('login'));
        }
    };
};

$isLoggedIn = function() use ($app) {
    $auth = new Auth($app);
    // if logged in redirect to your index (admin,teacher)
    if($auth->check()) {
        switch($auth->getUserRole()) {
            case 'admin':
                $app->redirect($app->urlFor('admin.index'));
                break;
            case 'teacher':
                $app->redirect($app->urlFor('teacher.index'));
                break;
        }
    }
};

// #### FORNYHO SERVICE ####
$app->get('/service/:segments+', function($segments) use ($app) {
    $API = new \IIA\service\MyAPI($segments, $app->config('db'));
    $responseData = $API->processAPI();
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body($responseData);
});

// tuna pridame vsetky cesty pre guesta

$app->get('/', function() use ($app) {
   $app->render('index.php');
})->name('site.index');

$app->get('/logout', function() use ($app) {
    $app->render('logout.php', ['app' => $app]);
})->name('logout');

$app->get('/login', $isLoggedIn, function() use ($app) {
    $app->render('login.php', ['app' => $app]);
})->name('login');

$app->post('/login', function() use ($app) {
    $app->render('authenticate.php', ['app' => $app]);
})->name('auth');


$app->group('/admin', $authenticateForRole('admin') ,function() use ($app) {

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

        $app->post('/create', function() use ($app) {
            $app->render('admin/subjects/store_subject.php', ['app' => $app]);
        })->name('admin.subjects.store');

        $app->get('/edit', function() use ($app) {
            $app->render('admin/subjects/edit_subject.php', ['app' => $app]);
        })->name('admin.subjects.edit');

        $app->post('/edit', function() use ($app) {
            $app->render('admin/subjects/update_subject.php', ['app' => $app]);
        })->name('admin.subjects.update');

        $app->get('/delete', function() use ($app) {
            $app->render('admin/subjects/delete_subject.php', ['app' => $app]);
        })->name('admin.subjects.delete');

        $app->post('/delete', function() use ($app) {
            $app->render('admin/subjects/remove_subject.php', ['app' => $app]);
        })->name('admin.subjects.remove');

    });



    $app->group('/roles', function() use ($app) {

        $app->get('/', function() use ($app) {
            $app->render('admin/roles/get_all_roles.php', ['app' => $app]);
        })->name('admin.roles');

        $app->get('/create', function() use ($app) {
            $app->render('admin/roles/create_role.php', ['app' => $app]);
        })->name('admin.roles.create');

        $app->post('/create', function() use ($app) {
            $app->render('admin/roles/store_role.php', ['app' => $app]);
        })->name('admin.roles.store');

        $app->get('/edit', function() use ($app) {
            $app->render('admin/roles/edit_role.php', ['app' => $app]);
        })->name('admin.roles.edit');

        $app->post('/edit', function() use ($app) {
            $app->render('admin/roles/update_role.php', ['app' => $app]);
        })->name('admin.roles.update');

        $app->get('/delete', function() use ($app) {
            $app->render('admin/roles/delete_role.php', ['app' => $app]);
        })->name('admin.roles.delete');

        $app->post('/delete', function() use ($app) {
            $app->render('admin/roles/remove_role.php', ['app' => $app]);
        })->name('admin.roles.remove');

    });

    $app->group('/groups', function() use ($app) {

        $app->get('/', function() use ($app) {
            $app->render('admin/groups/get_all_groups.php', ['app' => $app]);
        })->name('admin.groups');

        $app->get('/create', function() use ($app) {
            $app->render('admin/groups/create_group.php', ['app' => $app]);
        })->name('admin.groups.create');

        $app->post('/create', function() use ($app) {
            $app->render('admin/groups/store_group.php', ['app' => $app]);
        })->name('admin.groups.store');

        $app->get('/edit', function() use ($app) {
            $app->render('admin/groups/edit_group.php', ['app' => $app]);
        })->name('admin.groups.edit');

        $app->post('/edit', function() use ($app) {
            $app->render('admin/groups/update_group.php', ['app' => $app]);
        })->name('admin.groups.update');

        $app->get('/delete', function() use ($app) {
            $app->render('admin/groups/delete_group.php', ['app' => $app]);
        })->name('admin.groups.delete');

        $app->post('/delete', function() use ($app) {
            $app->render('admin/groups/remove_group.php', ['app' => $app]);
        })->name('admin.groups.remove');

    });


    $app->group('/lectures', function() use ($app) {

        $app->get('/', function() use ($app) {
            $app->render('admin/lectures/get_all_lectures.php', ['app' => $app]);
        })->name('admin.lectures');

        $app->get('/create', function() use ($app) {
            $app->render('admin/lectures/create_lecture.php', ['app' => $app]);
        })->name('admin.lectures.create');

        $app->post('/create', function() use ($app) {
            $app->render('admin/lectures/store_lecture.php', ['app' => $app]);
        })->name('admin.lectures.store');

        $app->get('/edit', function() use ($app) {
            $app->render('admin/lectures/edit_lecture.php', ['app' => $app]);
        })->name('admin.lectures.edit');

        $app->post('/edit', function() use ($app) {
            $app->render('admin/lectures/update_lecture.php', ['app' => $app]);
        })->name('admin.lectures.update');

        $app->get('/delete', function() use ($app) {
            $app->render('admin/lectures/delete_lecture.php', ['app' => $app]);
        })->name('admin.lectures.delete');

        $app->post('/delete', function() use ($app) {
            $app->render('admin/lectures/remove_lecture.php', ['app' => $app]);
        })->name('admin.lectures.remove');

    });

});


