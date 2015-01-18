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
	<title>Delete Consultation</title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<h1>Delete Consultation</h1>
					<form action="<?php echo $app->urlFor('admin.consultations.remove') ?>" method="POST">
					



					<select class="form-control" value="id" name="id">
						<?php foreach($consultations as $consultation): ?>




                                 <?php
                                    
                                    $db->join("subjects s", "c.subject_id=s.id", "LEFT");
                                    $db->where("s.id", $consultation['subject_id']);

                                    $subs = $db->get ("consultations c", null, "s.acronym, s.name");
                                  // var_dump($subs[0]);

                                    $sub= $subs[0][ 'name'];
                                    $acro = $subs[0]['acronym'];


                                    $db->join("users u", "c.user_id=u.id", "LEFT");
                                    $db->where("u.id", $consultation['user_id']);

                                    $usrs = $db->get ("consultations c", null, "u.title1, u.firstname, u.surname, u.title2");

                                    $surname = $usrs[0][ 'surname'];
                                    $firstname = $usrs[0][ 'firstname'];
                                    $t1 = $usrs[0][ 'title1'];
                                    $t2 = $usrs[0][ 'title2'];
                                    
                            
                                    ?>   




							<option name="<?php echo $consultation['id'] ?>" value="<?php echo $consultation['id'] ?>" >
								
								<?php echo $dayNames[$consultation['day']];
                                    echo ", "; echo $consultation['start_time']; echo "-"; echo $consultation['end_time']; 
                                    echo ", "; echo $acro; echo ", "; echo $t1; echo " "; echo $firstname; echo " "; echo $surname;
                                    echo ", "; echo $t2;  ?>

							</option>

						<?php endforeach; ?>

 					</select>

					<div>
					<input class="btn btn-primary" type="submit" value="delete" />
					</div>
					</form>
			</div>
		</div>
	</div>


	

</body>
</html>