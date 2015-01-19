<?php
use IIA\Lang\Lang as Lang;
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
	<title><?php echo Lang::get('navbar_brand') ?></title>
			<link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
</head>
<body>
      <div class="nav navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo Lang::get('navbar_brand') ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo $app->urlFor('login') ?>"><?php echo Lang::get('navbar_logout') ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
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