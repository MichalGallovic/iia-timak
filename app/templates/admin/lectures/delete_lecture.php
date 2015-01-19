<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$subjects = $db->get('subjects');
$users = $db->get('users');
$rooms = $db->get('rooms');
$lectures = $db->get('lectures');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <title><?php echo Lang::get('navbar_brand') ?></title>
            <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">

</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
    <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Delete Lecture</h1> 

                    <form action="<?php echo $app->urlFor('admin.lectures.remove'); ?>" method="POST">
                        
                                <select class='form-control' name="id" />

                                <?php foreach($lectures as $lecture): ?>
                                    <?php

                                    // join na subjects
                                    $db->join("subjects s", "l.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $lecture['subject_id']);

                                    $exers = $db->get ("lectures l", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na users
                                    $db->join("users u", "l.user_id=u.id", "LEFT");
                                    $db->where("u.id", $lecture['user_id']);

                                    $usrs = $db->get ("lectures l", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "l.room_id=r.id", "LEFT");
                                    $db->where("r.id", $lecture['room_id']);

                                    $rms = $db->get ("lectures l", null, "r.name");

                                    $rname = $rms[0]['name'];

                                   ?>

                                    <option value="<?php echo $lecture['id'] ?>">
                                        <?php echo $acro; echo ", "; echo $name; echo ", ";
                                         echo $lecture['start_time']; echo "-"; echo $lecture['end_time'];
                                          echo ", "; echo $rname;  echo ", "; 
                                        echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?>
                                    </option>
                                <?php endforeach; ?>

                                </select>

                        <input class='btn btn-primary' type="submit" value="delete" />
                    </form>
                    
                    
                </div>
            </div>
        </div>
  <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
       
</body>
</html>