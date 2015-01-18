<?php
use IIA\Lang\Lang as Lang;
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
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
                    <h1>Create Subject</h1> 

                    <form action="<?php echo $app->urlFor('admin.subjects.store'); ?>" method="POST">
                        
                    
                    <!-- <ul> -->         
                            <!-- <li>Code  <input type="text" name="code" /></li>
                            <li>Name <input type="text" name="name" /></li>
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
                            <!-- <li> --> <!-- <input type="text" name="color" /> --><!-- </li> -->
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
                            <!-- </li> -->

                    <!-- </ul> -->
                        <input class='btn btn-primary' type="submit" value="Add" />
                    </form>
                    
                    
                    
                </div>
            </div>
        </div>
   
</body>
</html>