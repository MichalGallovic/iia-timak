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
                <li><a href="<?php echo $app->urlFor('login') ?>"><?php echo Lang::get('navbar_login') ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
  
    <div class="container">
            <div class="row">
                <div class="col-md-3">
                        <h1>Create Role</h1>
                        <form action="<?php echo $app->urlFor('admin.roles.store'); ?>" method="POST">
                            
                        
<!--                         <ul>         
 -->                                
                                <input type="hidden" value="off" name="create" />
                                <input type="hidden" value="off" name="read" />
                                <input type="hidden" value="off" name="update" /> 
                                <input type="hidden" value="off" name="delete" />
                                <div class="form-group">
                                   <label >Name</label>
                                   <input type="text" class="form-control" name="name"/>
                                 </div>
                                <div class="form-group">
                                   <label >Can create:</label>
                                   <input type="checkbox"  name="create"/>
                                 </div>
                                 <div class="form-group">
                                   <label >Can read:</label>
                                   <input type="checkbox"  name="read"/>
                                 </div>
                                 <div class="form-group">
                                   <label >Can update:</label>
                                   <input type="checkbox"  name="update"/>
                                 </div>
                                 <div class="form-group">
                                   <label >Can delete:</label>
                                   <input type="checkbox"  name="delete"/>
                                 </div>

                                <!-- <li>Name <input  type="text" name="name" /> </li>
                                <li>Can create: <input type="checkbox" name="create" /> </li>
                                <li>Can read: <input type="checkbox" name="read"> </li>
                                <li>Can update: <input type="checkbox" name="update"> </li>
                                <li>Can delete: <input type="checkbox" name="delete"> </li> -->

<!--                         </ul>
 -->                            <input class="btn btn-primary" type="submit" value="Create Role" />
                        </form> 
                </div>
            </div>
        </div>

   
</body>
</html>