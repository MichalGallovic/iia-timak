<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);

$subjects = $db->get('subjects');
$users = $db->get('users');
$rooms = $db->get('rooms');

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
                <div class="col-md-4">
                    <h1>Create Lecture</h1> 

                    <form action="<?php echo $app->urlFor('admin.lectures.store'); ?>" method="POST">
                        
                   <!--  <ul> -->         
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


                           <!--  <li>Start time <input type="text" name="start_time" /></li>
                            <li>End time <input type="text" name="end_time" /></li> -->
                            <div class="form-group">
                               <label >Start time</label>
                               <input type="text" class="form-control" name="start_time"/>
                             </div>
                            <div class="form-group">
                               <label >End time</label>
                               <input type="text" class="form-control" name="end_time"/>
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
                           <!--  </li> -->



                            <!-- <li> -->
                            <div class="form-group">
                               <label >Room</label>
                                    <select class='form-control' name="room_id" />

                                <?php foreach($rooms as $room): ?>
                                    <option value="<?php echo $room['id'] ?>"><?php echo $room['name'];?></option>
                                <?php endforeach; ?>

                                </select>

                                </div>
                          
                           <!--  </li> -->

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

                   <!--  </ul> -->
                        <input class='btn btn-primary' type="submit" value="Add" />
                    </form>
                    
                    
                    
                </div>
            </div>
        </div>
    
</body>
</html>