<?php
use IIA\Lang\Lang as Lang;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
<!--     <link rel="stylesheet" type="text/css" href="/style/pridat_predmet/pridat_predmet.css">
 -->
    <script type="text/javascript" src="/js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="/js/libs/underscore.js"></script>
    <script type="text/javascript" src="/js/kontrola/kontrola.js"></script>

</head>
<body>
<!--HEADER-->
<?php $app->render('admin/_partials/header.php',['app' => $app]) ?>
<!--HEADER-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <td><?php echo Lang::get('common_subject') ?></td>
                        <td><?php echo Lang::get('common_isdefined') ?></td>
                    </tr>
                </thead>
                <tbody id="tabulka">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>