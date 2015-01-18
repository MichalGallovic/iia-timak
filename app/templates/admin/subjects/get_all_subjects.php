<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$subjects = $db->get('subjects');

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
	
</body>
</html>