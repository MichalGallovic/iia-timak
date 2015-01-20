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
					<h1><?php echo Lang::get('rooms_createheader') ?></h1>
					<form  method="POST">
						<div class="form-group">
						   <label ><?php echo Lang::get('common_name') ?></label>
						   <input type="text" class="form-control" name="room_name"/>
						 </div>
						<div>
						<input class="btn btn-primary" type="submit" name="add" value="<?php echo Lang::get('common_add') ?>"/>
						</div>

					</form>
					
					
				</div>
			</div>
		</div>
	
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	

	
</body>
</html>