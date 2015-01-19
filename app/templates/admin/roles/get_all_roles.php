<?php
use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;
$auth = new Auth($app);
$username = $auth->getFullName();

$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$roles = $db->get('roles');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo Lang::get('navbar_brand') ?></title>
	<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
<!--     <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
 --></head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Roles</h1>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Meno</th>
							<th>Create</th>
							<th>Read</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($roles as $role): ?>
							<tr><td><?php echo $role['name'];?></td><td><?php echo $role['create'];?></td><td><?php echo $role['read'];?></td><td><?php echo $role['update'];?></td><td><?php echo $role['delete'];?></td></tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
				
			</div>
		</div>
	</div>
 <script src="/js/libs/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
	
</body>
</html>