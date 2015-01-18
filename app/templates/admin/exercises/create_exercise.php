<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$subjects = $db->get('subjects');
$users = $db->get('users');
$rooms = $db->get('rooms');


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
    <link rel="stylesheet" href="/style/bootstrap-timepicker.min.css"/>
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
                    <h1>Create Exercise</h1>
                    <form action="<?php echo $app->urlFor('admin.exercises.store'); ?>" method="POST">
                        
                   <!--  <ul>  -->        
                          <!--   <li> -->

                                <div class="form-group">
                                   <label >Subjects</label>

                                <select class='form-control' name="subject_id" />

                                <?php foreach($subjects as $subject): ?>
                                    <option value="<?php echo $subject['id'] ?>"><?php echo $subject['acronym']; echo ", "; echo $subject['name']; echo ", "; echo $subject['code'];  ?></option>
                                <?php endforeach; ?>

                                </select>
                            </div>

                             <!-- </li> -->

                            
                            <div class="form-group">
                               <label >Start time</label>
                               <input id="timepicker1" type="text" class="form-control" name="start_time"/>
                             </div>
                            <!-- <li>Start time <input type="text" name="start_time" /></li> -->
                            <!-- <li>End time <input type="text" name="end_time" /></li> -->
                            <div class="form-group">
                               <label >End time</label>
                               <input id="timepicker2" type="text" class="form-control" name="end_time"/>
                             </div>
                            
                            <!-- <li> -->
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

                             <!-- <li> -->
                             <div class="form-group">
                                <label >Day</label> 

                                <select class='form-control' name="day" />

                                
                                    <option value="0">Monday</option>
                                    <option value="1">Tuesday</option>
                                    <option value="2">Wednesday</option>
                                    <option value="3">Thursday</option>
                                    <option value="4">Friday</option>
                                    <option value="5">Saturday</option>
                                    <option value="6">Sunday</option>
                               

                                </select>
                            </div>
                             <!-- </li> -->
                             

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="Add" />
                    </form> 
                    
                    
                </div>
            </div>
        </div>


    <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/js/libs/bootstrap-timepicker.min.js"></script>
    <script>
        $('#timepicker1').timepicker({
            minuteStep: 1,
            showMeridian: false
        });
        $('#timepicker2').timepicker({
            minuteStep: 1,
            showMeridian: false
        });
    </script>
</body>
</html>