<?php
use IIA\Lang\Lang as Lang;
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
    
<div class="nav navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo Lang::get('navbar_brand') ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $app->urlFor('login') ?>"><?php echo Lang::get('navbar_logout') ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
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
    
</body>
</html>