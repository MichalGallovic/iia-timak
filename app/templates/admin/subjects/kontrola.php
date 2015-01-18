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
<div class="nav navbar navbar-default">
    <div class="navbar-header"><span class="navbar-brand">FEI Timetable Master Overlord 10 001</span></div>
    <ul class="nav navbar-nav">
        <li><a href="add"><span id='nav-0'>Pridať Predmet</span></a></li>
        <li class="active"><a href="kontrola"><span id='nav-1'>Kontrola</span></a></li>
    </ul>
    <form id="logout" class="navbar-form navbar-right">
        <button id='logButt' type="submit" class="btn btn-primary">Odhlás</button>
    </form>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <td>Predmet</td>
                        <td>V rozvrhu?</td>
                    </tr>
                </thead>
                <tbody id="tabulka">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>