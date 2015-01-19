<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();

$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);


$id = $_SESSION['user_id'];
$db->where ('user_id', $id );
$consultations = $db->get('consultations');

$dayNames = array(
    
    0=>'Monday', 
    1=>'Tuesday', 
    2=>'Wednesday', 
    3=>'Thursday', 
    4=>'Friday', 
    5=>'Saturday', 
    6=>'Sunday'
 );

$dni = array(
    
    0=>'Pondelok', 
    1=>'Utorok', 
    2=>'Streda', 
    3=>'Štvrtok', 
    4=>'Piatok', 
    5=>'Sobota', 
    6=>'Nedeľa'
 );


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo Lang::get('navbar_brand') ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $username ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo $app->urlFor('admin.index') ?>"><i class="glyphicon glyphicon-user"></i> <?php echo Lang::get('navbar_profile') ?></a></li>
                            <li><a href="<?php echo $app->urlFor('teacher.settings')?>"><i class="glyphicon glyphicon-wrench"></i> <?php echo Lang::get('navbar_settings')?></a></li>
                            <li><a href="<?php echo $app->urlFor('logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <?php echo Lang::get('navbar_logout')?></a></li>
                        </ul>
                    </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>

<div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1><?php echo Lang::get('consultations_header') ?></h1>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php echo Lang::get('consultations_day') ?></th>
                                <th><?php echo Lang::get('consultations_note') ?></th>
                                <th><?php echo Lang::get('consultations_teacher') ?></th>
                                <th><?php echo Lang::get('consultations_start') ?></th>
                                <th><?php echo Lang::get('consultations_end') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($consultations as $consultation): ?>

                            <?php
                            
                                $db->join("users u", "c.user_id=u.id", "LEFT");
                                    $db->where("u.id", $consultation['user_id']);

                                    $usrs = $db->get ("consultations c", null, "u.title1, u.firstname, u.surname, u.title2");

                                    $surname = $usrs[0][ 'surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0][ 'title1'];
                                    $t2 = $usrs[0][ 'title2'];
                            ?>

                                <tr class='clickableRow' href='/teacher/NEVIEMAKYLINKSEMDATHADAMSITOTOPRECITASAFIXNES'><td><?php echo $dni[$consultation['day']];?></td><td><?php echo $consultation['note'];?></td>
                                    <td><?php echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?></td>
                                    <td><?php echo $consultation['start_time'];?></td><td><?php echo $consultation['end_time'];?></td></tr>
       
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    
                </div>
            </div>


        </div>

<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="/js/index/index.js"></script>
<script>
jQuery(document).ready(function($) {
      $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
});
 </script>
</body>
</html>