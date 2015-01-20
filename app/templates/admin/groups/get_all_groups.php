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

</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
	<div class="container">
			<div class="row">
				<div class="col-md-12">

					 <?php if($flash['message']): ?>
                        <div class="alert alert-info" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Info:</span>
                            <?php echo $flash['message'] ?>
                        </div>
                    <?php endif; ?>

					<h1><?php echo Lang::get('groups_header') ?></h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th><?php echo Lang::get('common_code') ?></th>
								<th><?php echo Lang::get('common_name') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($groups as $group): ?>
								<tr><td><?php echo $group['code']?></td><td><?php echo $group['name']; ?></td></tr>
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