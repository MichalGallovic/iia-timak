<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$users = $db->get('users');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">

</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Users</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($users as $user): ?>
								<tr><td><?php echo $user['title1']; echo " "; echo $user['firstname']; echo " ";
								 echo $user['surname']; echo " "; echo $user['title2']; ?></td></lr>
							<?php endforeach; ?>
						</tbody>
					</table>
						
					
					
				</div>
			</div>
		</div>
	
</body>
</html>