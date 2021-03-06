<?php

use IIA\Lang\Lang as Lang;
use IIA\Auth\Auth as Auth;

$auth = new Auth($app);
$username = $auth->getFullName();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo Lang::get('navbar_brand') ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/style/admin.css"/>
    </head>
    <body>
    <!--HEADER-->
    <?php $app->render('teacher/_partials/header.php',['app' => $app]) ?>
    <!--HEADER-->

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
                <div class="col-md-4">
                    <caption><h3>Počet vyučovaných hodín</h3></caption>
                    <table>
                        <thead>
                        <tr>
                            <th>
                                <a id="fullName" href="#">Meno a priezvisko</a>
                            </th>
                            <th>
                                <a id="lectureHours" href="#">Prednášky</a>
                            </th>
                            <th>
                                <a id="exerciseHours" href="#">Cvičenia</a>
                            </th>
                            <th>
                                <a id="totalHours" href=#">Spolu</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="usersHoursTable">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class='row'>
                <div class="col-md-8" id='bc' hidden>
                    <button id="getSch" class='btn btn-primary'>Zobraz</button>
                </div>
            </div>
            <div class='row'>
                <div class="col-md-8" id='bc' hidden>
                    <button id="getSch" class='btn btn-primary'>Zobraz</button>
                </div>
            </div>
            <div class='row'>
                <div class="col-md-12">
                    <div id='tabulka-wrapper'>
                        <table  class='table'>
                            <colgroup>
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">
                                <col span="1" style="width: 6.66%;">

                            </colgroup>
                            <thead>
                            <tr>
                                <th>Deň</th>
                                <th>6:00</th>
                                <th>7:00</th>
                                <th>8:00</th>
                                <th>9:00</th>
                                <th>10:00</th>
                                <th>11:00</th>
                                <th>12:00</th>
                                <th>13:00</th>
                                <th>14:00</th>
                                <th>15:00</th>
                                <th>16:00</th>
                                <th>17:00</th>
                                <th>18:00</th>
                                <th>19:00</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class='den' >Pondelok</td>
                                <td id='p-6' class='np'></td>
                                <td id='p-7' class='np'></td>
                                <td id='p-8' class='np'></td>
                                <td id='p-9' class='np'></td>
                                <td id='p-10' class='np'></td>
                                <td id='p-11' class='np'></td>
                                <td id='p-12' class='np'></td>
                                <td id='p-13' class='np'></td>
                                <td id='p-14' class='np'></td>
                                <td id='p-15' class='np'></td>
                                <td id='p-16' class='np'></td>
                                <td id='p-17' class='np'></td>
                                <td id='p-18' class='np'></td>
                                <td id='p-19' class='np'></td>
                            </tr>
                            <tr>
                                <td class='den' >Utorok</td>
                                <td class='np' id='u-6'></td>
                                <td class='np' id='u-7'></td>
                                <td class='np' id='u-8'></td>
                                <td class='np' id='u-9'></td>
                                <td class='np' id='u-10'></td>
                                <td class='np' id='u-11'></td>
                                <td class='np' id='u-12'></td>
                                <td class='np' id='u-13'></td>
                                <td class='np' id='u-14'></td>
                                <td class='np' id='u-15'></td>
                                <td class='np' id='u-16'></td>
                                <td class='np' id='u-17'></td>
                                <td class='np' id='u-18'></td>
                                <td class='np' id='u-19'></td>
                            </tr>
                            <tr>
                                <td class='den' >Streda</td>
                                <td class='np' id='s-6'></td>
                                <td class='np' id='s-7'></td>
                                <td class='np' id='s-8'></td>
                                <td class='np' id='s-9'></td>
                                <td class='np' id='s-10'></td>
                                <td class='np' id='s-11'></td>
                                <td class='np' id='s-12'></td>
                                <td class='np' id='s-13'></td>
                                <td class='np' id='s-14'></td>
                                <td class='np' id='s-15'></td>
                                <td class='np' id='s-16'></td>
                                <td class='np' id='s-17'></td>
                                <td class='np' id='s-18'></td>
                                <td class='np' id='s-19'></td>
                            </tr>
                            <tr>
                                <td class='den' >Štvrtok</td>
                                <td class='np' id='st-6'></td>
                                <td class='np' id='st-7'></td>
                                <td class='np' id='st-8'></td>
                                <td class='np' id='st-9'></td>
                                <td class='np' id='st-10'></td>
                                <td class='np' id='st-11'></td>
                                <td class='np' id='st-12'></td>
                                <td class='np' id='st-13'></td>
                                <td class='np' id='st-14'></td>
                                <td class='np' id='st-15'></td>
                                <td class='np' id='st-16'></td>
                                <td class='np' id='st-17'></td>
                                <td class='np' id='st-18'></td>
                                <td class='np' id='st-19'></td>
                            </tr>
                            <tr>
                                <td class='den' >Piatok</td>
                                <td class='np' id='pi-6'></td>
                                <td class='np' id='pi-7'></td>
                                <td class='np' id='pi-8'></td>
                                <td class='np' id='pi-9'></td>
                                <td class='np' id='pi-10'></td>
                                <td class='np' id='pi-11'></td>
                                <td class='np' id='pi-12'></td>
                                <td class='np' id='pi-13'></td>
                                <td class='np' id='pi-14'></td>
                                <td class='np' id='pi-15'></td>
                                <td class='np' id='pi-16'></td>
                                <td class='np' id='pi-17'></td>
                                <td class='np' id='pi-18'></td>
                                <td class='np' id='pi-19'></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <form id='tlaciaren' action="<?php echo $app->urlFor('genPdf') ?>" method='post'>
                                 <input id="kone"  type="text" name="print_url"  hidden>
                                 <button class='btn btn-primary' type='submit'>tlaciaren</button>
                               </form>
                </div>
            </div>
        </div>



        <script src="/js/libs/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="/js/index/index.js"></script>
<!--        FORNYHO JS-->
        <script>
            $(document).ready(function() {
                var order = {
                    users : "asc",
                    lectureHours : "asc",
                    exercisesHours : "asc",
                    totalHours : "asc"
                };
                renderTableOnLoad('fullName','asc');

                $('#fullName').click(function() {
                    var newOrder = toggleOrder("fullName");
                    var response = getUsersHours('fullName',newOrder);
                });

                $('#lectureHours').click(function() {
                    var newOrder = toggleOrder("lectureHours");
                    var response = getUsersHours('lectureHours',newOrder);
                });

                $('#exerciseHours').click(function() {
                    var newOrder = toggleOrder("exerciseHours");
                    var response = getUsersHours('exerciseHours',newOrder);
                });


                $('#totalHours').click(function() {
                    var newOrder = toggleOrder("totalHours");
                    var response = getUsersHours('totalHours',newOrder);
                });

                function toggleOrder(orderBy) {
                    var currentOrder = order[orderBy];
                    order[orderBy] = (currentOrder == 'asc') ? 'desc' : 'asc';
                    return order[orderBy];
                }

                function getUsersHours(orderedBy, orderedMode) {
                    var params = "?orderedBy=" + orderedBy + '&orderedMode=' + orderedMode;
                    $.ajax({
                        type: "GET",
                        url: '/service/usersHours' + params,
                        dataType: 'json',
                        success: function(data) {
                            $('#usersHoursTable').html("");
                            $.each(data, function(i, item) {
                                var tableRow;
                                tableRow += '<tr>';
                                tableRow += '<td>' + item.fullName + '</td>';
                                tableRow += '<td>' + item.lectureHours + '</td>';
                                tableRow += '<td>' + item.exerciseHours + '</td>';
                                tableRow += '<td>' + item.totalHours + '</td>';
                                tableRow += '</tr>';
                                $('#usersHoursTable').append(tableRow);
                            });
                        }});
                }

                function renderTableOnLoad(orderBy, orderedMode) {
                    getUsersHours(orderBy,orderedMode);
                }
            });
        </script>
    </body>
</html>