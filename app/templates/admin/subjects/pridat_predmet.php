<!DOCTYPE html>
<html lang="en">
<head>
    <title>IIA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/style/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/style/pridat_predmet/pridat_predmet.css">

    <script type="text/javascript" src="/js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="/js/libs/underscore.js"></script>
    <script type="text/javascript" src="/js/pridat_predmet/pridat_predmet.js"></script>

</head>
<body>
<div class="nav navbar navbar-default">
    <div class="navbar-header"><span class="navbar-brand">FEI Timetable Master Overlord 10 001</span></div>
    <ul class="nav navbar-nav">
        <li class="active"><a href="pridat_predmet.html">Pridat Predmet</a></li>
        <li><a href="kontrola.html">Kontrola</a></li>
    </ul>
    <form id="logout" class="navbar-form navbar-right">
        <button type="submit" class="btn btn-primary">Odhlas</button>
    </form>
</div>
<form action="insert_subject.php" method="get">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Pridat Predmet POZOR ORDER!!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>Vyber semestra:</h3>
                <select name="select_term" id="select_term" class="form-control">
                    <option value="skovaj">vyber typ</option>
                    <option value="zimny">zimny</option>
                    <option value="letny">letny</option>
                </select>
            </div>
            <div class="col-md-4">
                <div id="druhy_select_admin" hidden>
                    <h3>Predmet:</h3>
                    <select name="select_subject" id="select_subject" class="form-control"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div id="treti_select_admin" hidden>
                    <h3>pocet cviceni:</h3>
                    <select name="select_exc_count" id="select_exc_count" class="form-control">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="prednaska_admin" hidden class="col-md-4">
                <h2>Prednaska</h2>
                <h3>Prednasajuci:</h3>
                <select name="select_lecturer" id="select_prednasajuciP_admin" class="form-control">
                    <option value="jozo">jozo</option>
                    <option value="kone">kone</option>
                </select>
                <h3>den:</h3>
                <select name="select_day" id="select_denP_admin" class="form-control">
                    <option value="pondelok">pondelok</option>
                    <option value="utorok">utorok</option>
                    <option value="streda">streda</option>
                    <option value="stvrtok">stvrtok</option>
                    <option value="piatok">piatok</option>
                </select>
                <h3>cas:</h3>
                <select name="select_time" id="select_casP_admin" class="form-control">
                    <option value="0600">06:00</option>
                    <option value="0700">07:00</option>
                    <option value="0800">08:00</option>
                    <option value="0900">09:00</option>
                    <option value="1000">10:00</option>
                    <option value="1100">11:00</option>
                    <option value="1200">12:00</option>
                    <option value="1300">13:00</option>
                    <option value="1400">14:00</option>
                    <option value="1500">15:00</option>
                    <option value="1600">16:00</option>
                    <option value="1700">17:00</option>
                    <option value="1800">18:00</option>
                    <option value="1900">19:00</option>
                    <option value="2000">20:00</option>
                </select>
                <h3>miestnost:</h3>
                <select name="select_place" id="select_miestnostP_admin" class="form-control">
                    <option value="ab301">ab301</option>
                    <option value="bc301">bc301</option>
                </select>
            </div>
            <div class="col-md-4"></div>
            <div id="cvicenie_admin" hidden class="col-md-4">
                <button id="doLava" class="btn btn-primary"><<</button>
                <button id="doPrava" class="btn btn-primary">>></button>
                <div id="cvicenie_admin_cont"></div>

            </div>
        </div>
        <div id="add_predmet_wrap" hidden class="row">
            <button type="submit" class="btn btn-primary">Pridaj Predmet</button>
        </div>
    </div>
</form>
</body>
</html>