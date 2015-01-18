<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$groups = $db->get('groups');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">

</head>
<body>
	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Groups</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
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
	
</body>
</html>