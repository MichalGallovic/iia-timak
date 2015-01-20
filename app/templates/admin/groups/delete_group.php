<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();

$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('groups');

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
					<h1><?php echo Lang::get('groups_deleteheader') ?></h1>

					<form action="<?php echo $app->urlFor('admin.groups.remove') ?>" method="POST">
					<select class='form-control' value="id" name="id">
						<?php foreach($groups as $group): ?>
							<option name="<?php echo $group['id'] ?>" value="<?php echo $group['id'] ?>" > <?php echo $group['code']; echo " - "; echo $group['name'];  ?> </option>
						<?php endforeach; ?>

					</select>

					<input class='btn btn-primary' type="submit" value="<?php echo Lang::get('common_delete') ?>" />
					</form>
					
					
				</div>
			</div>
		</div>
	 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	

</body>
</html>