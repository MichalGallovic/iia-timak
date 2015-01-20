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


<!--HEADER-->
<?php $app->render('teacher/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->

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
                                <th><?php echo Lang::get('consultations_delete') ?></th>
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

                                <tr class='clickableRow' href="<?php echo $app->urlFor('teacher.consultations').'/'. $consultation['id']; ?>"><td><?php echo $dni[$consultation['day']];?></td><td><?php echo $consultation['note'];?></td>
                                    <td><?php echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?></td>
                                    <td><?php echo $consultation['start_time'];?></td><td><?php echo $consultation['end_time'];?></td>
                                    <td> 
                                            <form action="<?php echo $app->urlFor('teacher.consultations').'/delete/'. $consultation['id']; ?>" method="post"?>
                                            
                                                <input type="hidden" name="id" value="<?php echo $consultation['id'];?>"/>
                                            <button class='btn btn-primary' type="submit"> <?php echo Lang::get('consultations_delete') ?> </button> 
                                            </form>


                                    </td></tr>
       
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <a class='btn btn-primary' href="<?php echo $app->urlFor('teacher.consultations.create'); ?>" >
                      <?php echo Lang::get('consultations_add') ?> 
                    </a>
                    
                </div>
            </div>

            <!-- <?php //echo $app->urlFor('teacher.consultations').'/edit/'.'1' ?> -->
            <!-- <?php //echo $app->urlFor('teacher.consultations').'/1' ?> -->
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