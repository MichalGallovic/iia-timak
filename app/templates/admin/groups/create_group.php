<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();

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
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
    <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1>Create Group</h1>

                    <form  action="<?php echo $app->urlFor('admin.groups.store') ?>" method="POST">
                       <!--  <ul> -->
                       <div class="form-group">
                          <label >Group name</label>
                          <input type="text" class="form-control" name="name"/>
                        </div>
                        <div class="form-group">
                           <label >Group code</label>
                           <input type="text" class="form-control" name="code"/>
                         </div>
<!--                             <li>Group name: <input type="text" name="name" /></li>
                             <li>Group code: <input type="text" name="code" /></li>
 -->                        <!-- </ul> -->
                        
                        <input class='btn btn-primary' type="submit" value="add" />
                    </form>
                    
                    
                </div>
            </div>
        </div>
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  
    
</body>
</html>