<?php
$credentials = $app->config('db');
$db = new MysqliDb($credentials['host'], $credentials['username'],
            $credentials['password'], $credentials['dbName']);
$consultations = $db->get('consultations');

$dayNames = array(
    
    0=>'Monday', 
    1=>'Tuesday', 
    2=>'Wednesday', 
    3=>'Thursday', 
    4=>'Friday', 
    5=>'Saturday', 
    6=>'Sunday'
 );

$dni = array(
    
    0=>'Pondelok', 
    1=>'Utorok', 
    2=>'Streda', 
    3=>'Štvrtok', 
    4=>'Piatok', 
    5=>'Sobota', 
    6=>'Nedeľa'
 );

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
								<th>Teacher</th>
								<th>Start</th>
								<th>End</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($consultations as $consultation): ?>

							<?php
							
								$db->join("users u", "c.user_id=u.id", "LEFT");
                                    $db->where("u.id", $consultation['user_id']);

                                    $usrs = $db->get ("consultations c", null, "u.title1, u.firstname, u.surname, u.title2");

                                    $surname = $usrs[0][ 'surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0][ 'title1'];
                                    $t2 = $usrs[0][ 'title2'];
							?>

								<tr><td><?php echo $dni[$consultation['day']];?></td><td><?php echo $consultation['note'];?></td>
									<td><?php echo $t1; echo " "; echo $firstname; echo " "; echo $surname; echo " "; echo $t2; ?></td>
									<td><?php echo $consultation['start_time'];?></td><td><?php echo $consultation['end_time'];?></td></tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
					
				</div>
			</div>
		</div>
	
		

</body>
</html>