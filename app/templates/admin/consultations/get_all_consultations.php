<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$consultations = $db->get('consultations');

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
					<h1>Consultations</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Day</th>
								<th>Note</th>
								<th>Start</th>
								<th>End</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($consultations as $consultation): ?>
								<tr><td><?php echo $consultation['day'];?></td><td><?php echo $consultation['note'];?></td><td><?php echo $consultation['start_time'];?></td><td><?php echo $consultation['end_time'];?></td></tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					
				</div>
			</div>
		</div>
	
		

</body>
</html>