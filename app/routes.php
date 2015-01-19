<?php
use IIA\Auth\Auth as Auth;
use IIA\Lang\Lang as Lang;
use IIA\service\TimetableApi as TimetableApi;

// routes
// check login and set url according to role

$authenticateForRole = function($role = 'guest') use ($app) {
    return function() use ($role,$app) {
        $auth = new Auth($app);

        if($auth->check()) {
            // check for role
            $userRole = $auth->getUserRole();
            if($userRole != $role) {
                $app->redirect($app->urlFor($userRole.'.index'));
            }
        } else {
            $app->redirect($app->urlFor('login'));
        }
    };
};

// if logged in redirect to your index (admin,teacher)
$isLoggedIn = function() use ($app) {
    $auth = new Auth($app);
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

$app->get('/print', function() use ($app) {
    $app->render('print.php', ['app' => $app]);
});

$app->get('/service/:segments+', function($segments) use ($app) {
    $API = new TimetableApi($segments, $app->config('db'));
    $responseData = $API->processAPI();
    $response = $app->response();
    $response['Content-Type'] = 'application/json';
    $response->body($responseData);
});



// if no lang in url prepend url with default lang (sk)
$setLang = function() use ($app){

    $lang = substr($app->request()->getResourceUri(), 1, 2);

    if(!in_array($lang,['sk','en'])) {
        Lang::setLocale($app->config('lang'));
        $app->redirect('/'.$app->config('lang').$app->request()->getResourceUri());
    } else {
        Lang::setLocale($lang);
    }
};

$app->group('(/:lang)',$setLang,function() use ($app,$isLoggedIn,$authenticateForRole) {

    // tuna pridame vsetky cesty pre guesta

    $app->get('/', function() use ($app) {
        $app->render('index.php', ['app' => $app]);
    })->name('site.index');

    $app->get('/genPdf', function() use ($app) {
        $app->render('genPdf.php', ['app' => $app]);
    })->name('genPdf');

    $app->get('/logout', function() use ($app) {
        $app->render('logout.php', ['app' => $app]);
    })->name('logout');

    $app->get('/login', $isLoggedIn, function() use ($app) {
        $app->render('login.php', ['app' => $app]);
    })->name('login');

    $app->get('/google-login', function() use ($app) {
        $app->render('googleAuth.php',['app'=>$app]);
    })->name('auth.google');

    $app->get('/google-unlink', function() use ($app) {
        $auth = new Auth($app);
        $auth->unlinkGoogle();
    })->name('unlink.google');

    $app->post('/login',$isLoggedIn, function() use ($app) {
        $app->render('authenticate.php', ['app' => $app]);
    })->name('auth');


    $app->group('/admin', $authenticateForRole('admin') ,function() use ($app) {

        $app->get('/', function() use ($app) {
            $app->render('admin/index.php', ['app'=>$app]);
        })->name('admin.index');

        $app->get('/dump', function() use ($app){
            if(isset($_GET['token'])) {
                if($_GET['token'] == $_SESSION['form_token']) {
                    $fileName = time().'file.sql';
                    $filePath = dirname(__FILE__).'/../public/dumps/'.$fileName;
                    $output = '';
                    $result = '';
                    exec('mysqldump --user=root --password='.$app->config('db')['password'].' --host=localhost iiaTimak >'.$filePath,$output,$result);
                    header('Content-type: application/octetstream'); //this could be a different header
                    header('Content-Disposition: attachment; filename="'.$fileName.'"');

                    ignore_user_abort(true);

                    $context = stream_context_create();
                    $file = fopen($filePath, 'rb', FALSE, $context);
                    while(!feof($file))
                    {
                        echo stream_get_contents($file, 2014);
                    }
                    fclose($file);
                    flush();
                    if (file_exists($filePath)) {
                        unlink( $filePath );
                    }
                }
            }
            $app->redirect($app->urlFor('login'));
        })->name('admin.dump');

        $app->post('/dump', function() use ($app) {
            $app->render('admin/importdump.php', ['app' => $app]);
        })->name('admin.dump.import');

        $app->get('/settings', function() use ($app) {
            $app->render('admin/settings.php',['app' => $app]);
        })->name('admin.settings');


        $app->group('/schedules', function() use ($app) {
            $app->get('', function() use ($app) {

            })->name('admin.schedules');

            $app->get('/create', function() use ($app) {
                $app->render('admin/subjects/pridat_predmet.php', ['app' => $app]);
            })->name('admin.schedules.create');

            $app->get('/check', function() use ($app) {
                $app->render('admin/subjects/kontrola.php',['app' => $app]);
            })->name('admin.schedules.check');
        });

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


        $app->group('/consultations', function() use ($app) {

            $app->get('/', function() use ($app) {
                $app->render('admin/consultations/get_all_consultations.php', ['app' => $app]);
            })->name('admin.consultations');

            $app->get('/create', function() use ($app) {
                $app->render('admin/consultations/create_consultation.php', ['app' => $app]);
            })->name('admin.consultations.create');

            $app->post('/create', function() use ($app) {
                $app->render('admin/consultations/store_consultation.php', ['app' => $app]);
            })->name('admin.consultations.store');

            $app->get('/edit', function() use ($app) {
                $app->render('admin/consultations/edit_consultation.php', ['app' => $app]);
            })->name('admin.consultations.edit');

            $app->post('/edit', function() use ($app) {
                $app->render('admin/consultations/update_consultation.php', ['app' => $app]);
            })->name('admin.consultations.update');

            $app->get('/delete', function() use ($app) {
                $app->render('admin/consultations/delete_consultation.php', ['app' => $app]);
            })->name('admin.consultations.delete');

            $app->post('/delete', function() use ($app) {
                $app->render('admin/consultations/remove_consultation.php', ['app' => $app]);
            })->name('admin.consultations.remove');

        });

        $app->group('/exercises', function() use ($app) {

            $app->get('/', function() use ($app) {
                $app->render('admin/exercises/get_all_exercises.php', ['app' => $app]);
            })->name('admin.exercises');

            $app->get('/create', function() use ($app) {
                $app->render('admin/exercises/create_exercise.php', ['app' => $app]);
            })->name('admin.exercises.create');

            $app->post('/create', function() use ($app) {
                $app->render('admin/exercises/store_exercise.php', ['app' => $app]);
            })->name('admin.exercises.store');

            $app->get('/edit', function() use ($app) {
                $app->render('admin/exercises/edit_exercise.php', ['app' => $app]);
            })->name('admin.exercises.edit');

            $app->post('/edit', function() use ($app) {
                $app->render('admin/exercises/update_exercise.php', ['app' => $app]);
            })->name('admin.exercises.update');

            $app->get('/delete', function() use ($app) {
                $app->render('admin/exercises/delete_exercise.php', ['app' => $app]);
            })->name('admin.exercises.delete');

            $app->post('/delete', function() use ($app) {
                $app->render('admin/exercises/remove_exercise.php', ['app' => $app]);
            })->name('admin.exercises.remove');

        });

        $app->group('/users', function() use ($app) {

            $app->get('/', function() use ($app) {
                $app->render('admin/users/get_all_users.php', ['app' => $app]);
            })->name('admin.users');

            $app->get('/create', function() use ($app) {
                $app->render('admin/users/create_user.php', ['app' => $app]);
            })->name('admin.users.create');

            $app->post('/create', function() use ($app) {
                $app->render('admin/users/store_user.php', ['app' => $app]);
            })->name('admin.users.store');

            $app->get('/edit', function() use ($app) {
                $app->render('admin/users/edit_user.php', ['app' => $app]);
            })->name('admin.users.edit');

            $app->post('/edit', function() use ($app) {
                $app->render('admin/users/update_user.php', ['app' => $app]);
            })->name('admin.users.update');

            $app->get('/delete', function() use ($app) {
                $app->render('admin/users/delete_user.php', ['app' => $app]);
            })->name('admin.users.delete');

            $app->post('/delete', function() use ($app) {
                $app->render('admin/users/remove_user.php', ['app' => $app]);
            })->name('admin.users.remove');

        });

    });


    $app->group('/teacher', $authenticateForRole('teacher'), function() use ($app) {

        $app->get('', function() use ($app) {
            $app->render('teacher/index.php', ['app'=>$app]);
        })->name('teacher.index');

        $app->get('/settings', function() use ($app) {
            $app->render('teacher/settings.php', ['app'=>$app]);
        })->name('teacher.settings');

        $app->get('/consultations', function() use ($app) {
            $app->render('teacher/consultations.php', ['app'=>$app]);
        })->name('teacher.consultations');

        $app->get('/consultations/create', function() use ($app) {
            $app->render('teacher/create_consultation.php', ['app'=>$app]);
        })->name('teacher.consultations.create');

         $app->post('/consultations/create', function() use ($app) {
            $app->render('teacher/store_consultation.php', ['app'=>$app]);
        })->name('teacher.consultations.store');

       $app->post('/consultations/delete/:konkretna', function() use ($app) {
            $app->render('teacher/remove_consultation.php', ['app' => $app]);
        })->name('teacher.consultations.remove');

        $app->get('/consultations/:konkretna', function() use ($app) {
            $urlSegments = explode('/',$app->request()->getResourceUri());
            $id = $urlSegments[count($urlSegments)-1];
            $app->render('teacher/show_consultation.php', ['app' => $app,'id' => $id]);
        })->name('teacher.consultations.show');

        $app->post('/consultations/:konkretna', function() use ($app) {
            $urlSegments = explode('/',$app->request()->getResourceUri());
            $id = $urlSegments[count($urlSegments)-1];
            $app->render('teacher/update_consultation.php', ['app' => $app,'id' => $id]);
        })->name('teacher.consultations.update');


        $app->get('/consultations/edit/:konkretna', function() use ($app) {
            $urlSegments = explode('/',$app->request()->getResourceUri());
            $id = $urlSegments[count($urlSegments)-1];
            $app->render('teacher/edit_consultation.php', ['app' => $app,'id' => $id]);
        })->name('teacher.consultations.edit');


    });

});
