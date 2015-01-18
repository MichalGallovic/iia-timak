<?php
use IIA\Lang\Lang as Lang;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo Lang::get('navbar_brand') ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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
                <li><a href="<?php echo $app->urlFor('login') ?>"><?php echo Lang::get('navbar_login') ?></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1></h1>
        </div>
    </div>
    <div class="row">
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