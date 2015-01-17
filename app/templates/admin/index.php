<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <script src="/js/libs/jquery.min.js"></script>
    <script src="/js/index/index.js"></script>
</head>
<body>
<div class="nav navbar navbar-default">
    <div class="navbar-header"><span class="navbar-brand">FEI Timetable Master Overlord 10 001</span></div>
    <form id="login" class="navbar-form navbar-right">
        <input type="text" placeholder="Meno" required class="form-control">
        <input type="password" placeholder="Heslo" required class="form-control">
        <button type="submit" class="btn btn-primary">Prihlás</button>
    </form>
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
        </div>
    </div>
</div>
</body>
</html>