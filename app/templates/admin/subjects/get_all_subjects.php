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

</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					
					<h1>Subjects</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Code</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($subjects as $subjects): ?>
								<tr><td><?php echo $subjects['name']; ?></td><td><?php echo $subjects['code']; ?></td></tr>
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