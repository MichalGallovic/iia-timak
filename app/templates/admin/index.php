<?php
use IIA\Auth\Auth as Auth;
use IIA\Lang\Lang as Lang;
$auth = new Auth($app);
$username = $auth->getFullName();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/admin.css"/>
</head>
<body>
<!--HEADER-->
<?php include dirname(__FILE__).'/_partials/header.php' ?>
<!--HEADER-->

<div class="container">

    <div class="row margin-20">
        <div class="col-md-4">
            <h3>Zobraz rozvrh pre:</h3>
            <select id="select_type" class="form-control">
                <option value="skovaj">typ</option>
                <option value="predmet">predmet</option>
                <option value="ucitel">učiteľ</option>
                <option value="skupina_ucitelov">skupina učiteľov</option>
                <option value="miestnost">miestnosť</option>
                <option value="den">deň</option>
                <option value="oddelenie">oddelenie</option>
            </select>
        </div>
        <div class="col-md-4">
            <div id="druhy_select" hidden>
                <h3>Druhy Select:</h3>
                <select id="select_detail" class="form-control"></select>
            </div>
            <div id="druhy_select_ucitelia" hidden>
                <h3>Druhy Select: kone</h3>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-12" id='bc' hidden>
            <button id="getSch" class='btn btn-primary'>Zobraz</button>
        </div>    
    </div>
</div>
<script src="/js/libs/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="/js/index/index.js"></script>
</body>
</html>