<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
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
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
	<div class="container">
			<div class="row">
				<div class="col-md-3">
					<h1><?php echo Lang::get('rooms_editheader') ?></h1>
					<label><?php echo Lang::get('common_room') ?></label>
					<form action="<?php echo $app->urlFor('admin.rooms.update'); ?>" method="POST">
					<select class='form-control' value="id" name="id">
						<?php foreach($rooms as $room): ?>
							<option name="<?php echo $room['id'] ?>" value="<?php echo $room['id'] ?>" > <?php echo $room['name'] ?> </option>
						<?php endforeach; ?>

					</select>

<!-- 					<input class='form-control' type="text" name="newname" />
 -->
					<div class="form-group">
					   <label ><?php echo Lang::get('common_name') ?></label>
					   <input type="text" class="form-control" name="newname"/>
					 </div>
					<div>
					<input class="btn btn-primary" type="submit" value="<?php echo Lang::get('crud_edit') ?>" />
					</div>
					</form>
					
					
				</div>
			</div>
		</div>
	
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	

</body>
</html>