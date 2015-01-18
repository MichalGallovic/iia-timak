<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$subjects = $db->get('subjects');
$users = $db->get('users');
$rooms = $db->get('rooms');
$groups = $db->get('exercises');


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
                <div class="col-md-5">
                    <h1>Edit  Exercise</h1>
                    <form action="<?php echo $app->urlFor('admin.exercises.update'); ?>" method="POST">
                        
                        <select class='form-control' value="id" name="id">
                        <?php foreach($groups as $group): ?>


                              <?php
                                    // join na subjects 
                                    $db->join("subjects s", "e.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $group['subject_id']);

                                    $exers = $db->get ("exercises e", null, "s.acronym, s.name");

                                    $acro = $exers[0][ 'acronym'];
                                    $name = $exers[0][ 'name'];
                                    

                                    // join na exercises
                                    $db->join("users u", "e.user_id=u.id", "LEFT");
                                    $db->where("u.id", $group['user_id']);

                                    $usrs = $db->get ("exercises e", null, "u.title1, u.title2, u.firstname, u.surname");

                                    $surname = $usrs[0]['surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0]['title1'];
                                    $t2 = $usrs[0]['title2'];


                                    // join na rooms
                                    $db->join("rooms r", "e.room_id=r.id", "LEFT");
                                    $db->where("r.id", $group['room_id']);

                                    $rms = $db->get ("exercises e", null, "r.name");

                                    $rname = $rms[0]['name'];

                                    ?>


                            <option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > 
                            <?php echo $acro; echo ", "; echo $name; echo ", "; echo $rname; 
                            echo ", ";echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " ";
                            echo $t2; echo ", "; echo $dni[$group['day']]; echo " "; echo $group['start_time']; ?>


                             </option>
                        <?php endforeach; ?>

                    </select>


                    <!-- <ul> -->         
                            <!-- <li> -->
                            <div class="form-group">
                               <label >Subjects</label>

                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>

                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                             <!-- </li> -->


                            <!-- <li> -->
                            <div class="form-group">
                               <label >Start time</label> 
                               <input class='form-control' type="text" name="start_time" />
    
                                </div>
                               <!-- </li> -->
                           <!--  <li> -->
                           <div class="form-group">
                               <label >End time</label> 
                                <input class='form-control' type="text" name="end_time" />
                            </div><!-- </li> -->
                            
                           <!--  <li> -->
                           <div class="form-group">
                              <label >Teacher</label> 
                                <select class='form-control' name="user_id" />

                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['title1']; echo " "; echo $user['firstname']; echo ", "; echo $user['surname']; echo " "; echo $user['title2'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>
                            <!-- </li> -->



                            <!-- <li> -->
                            <div class="form-group">
                               <label >Room</label>
                             

                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                                
                          
                            <!-- </li> -->

                            <!--  <li> -->
                            <div class="form-group">
                               <label >Day</label>

                                <select class='form-control' name="day" />

                                
                                    <option value="0">Mon</option>
                                    <option value="1">Tue</option>
                                    <option value="2">Wed</option>
                                    <option value="3">Thu</option>
                                    <option value="4">Fri</option>
                                    <option value="5">Sat</option>
                                    <option value="6">Sun</option>
                               

                                </select>
                            </div>

                          <!--    </li> -->
                             

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="Add" />
                    </form> 
                    
                    
                </div>
            </div>
        </div>
    

    
</body>
</html>