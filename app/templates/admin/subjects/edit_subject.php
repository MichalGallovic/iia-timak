<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$subjects = $db->get('subjects');

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
                <div class="col-md-5">
                        <h1>Edit Subject</h1>
                        <p>Select room to edit</p>
                        <form action="<?php echo $app->urlFor('admin.subjects.update') ?>" method="POST">
                        <select class='form-control' value="id" name="id">
                            <?php foreach($subjects as $subject): ?>
                                <option name="<?php echo $subject['id'] ?>" value="<?php echo $subject['id'] ?>" > <?php echo $subject['name'] ?> </option>
                            <?php endforeach; ?>

                        </select>

                        <!--  <ul>         
                                <li>Code  <input type="text" name="code" /></li>
                                <li>Name <input type="text"  name="newname" /></li>
                                <li>Acronym <input type="text" name="acronym" /></li> -->
                                <div class="form-group">
                                   <label >Code</label>
                                   <input type="text" class="form-control" name="code"/>
                                 </div>
                                 <div class="form-group">
                                    <label >Name</label>
                                    <input type="text" class="form-control" name="name"/>
                                  </div>
                                  <div class="form-group">
                                     <label >Acronym</label>
                                     <input type="text" class="form-control" name="acronym"/>
                                   </div>
                                <!-- <li> -->
                                    
                                    <div class="form-group">
                                       <label >Lecture duration</label>
                                

                                        <select class='form-control' name="lecture_duration">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                </div>
                                    <!-- </li> -->
                                <!-- <li> -->

                                <div class="form-group">
                                   <label >Exercise duration</label>


                                        <select class='form-control' name="exercise_duration">
                                            
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            
                                        </select>
                                    </div>
                                <!-- </li> -->
<!--                                 <li>Color TUTO KUBO POROB KOLOR PIKER (PIKENKO) <input type="text" name="color" /></li>
 -->                                
                                        <div class="form-group">
                                           <label >Color</label>
                                           <input type="color" class="form-control" name="color"/>
                                         </div>

 <!-- <li> -->


                                <div class="form-group">
                                   <label >Term</label>

                                        <select class='form-control' name="term">
                                            
                                            <option value="W">winter</option>
                                            <option value="S">summer</option>
                                           
                                            
                                        </select>
                                    </div>


                               <!--  </li> -->

                        <!-- </ul> -->


                        <input class='btn btn-primary' type="submit" value="edit" />
                        </form>

                    
                    
                </div>
            </div>
        </div>
	
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
</body>
</html>