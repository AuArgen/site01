<?php 
session_start();
include("include/db_connect.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
  <title>Баа</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/jk-style.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <style type="text/css">

  </style>
</head>
<body>
  <div id="wrapper">
    <div class="overlay"></div>
    
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
      <ul class="nav sidebar-nav">

        <li class="sidebar-brand">

         <div class="togolok">K</div>

       </li>

       <div class="kundoluk">Күндөлүк</div>

       <li>

        <a href="forma.php"><i id="profill" class="fa fa-user-circle-o" aria-hidden="true"></i> Профиль</a>
      </li>

                 <li>
                    <a href="raspisanie.php"><i id="rasp" class="fa fa-calendar-check-o" aria-hidden="true"></i>Расписание</a>
                  </li> 

                  <li>
                    <a href="cheirek.php"><i id="baa" class="fa fa-star-o" aria-hidden="true"></i>Чертвертные оценки</a>
                  </li>
                  <li>
                    <a href="test.php"><i id="pasish" class="fa fa-line-chart" aria-hidden="true"></i>Тест</a>
                  </li>
                  <li>
                    <a href="tapshyrma.php"> <i id="zadan" class="fa fa-pencil-square-o" aria-hidden="true"></i>Домашнее Задание</a>
                  </li>
                  <li>
                    <a href="baalar.php"><i id="surnai" class="fa fa-star" aria-hidden="true"></i>Оценка</a>
                  </li>
                  <li>
                    <a href="janylyk.php"><i id="surnai" class="fa fa-bullhorn" aria-hidden="true"></i>Объявление</a>
                  </li>
                  <li>
                    <div class="soob"><a href="sms.php"> <i id="sms" class="fa fa-envelope" aria-hidden="true"></i>(1) Сообщения</div></a>
                  </li>

                  <li>
                    <a href="index.php"><i id="exit" class="fa fa-sign-out" aria-hidden="true"></i>Выход</a>
                  </li>
                </ul>
              </nav>
              <!-- /#sidebar-wrapper -->

              <!-- Page Content -->
              <div id="page-content-wrapper">
                <button id="menuk" type="button" class="hamburger is-closed" data-toggle="offcanvas">
                  <span class="hamb-top"></span>
                  <span class="hamb-middle"></span>
                  <span class="hamb-bottom"></span>
                </button>

                <div class="janylyktar">Оценка</div>
             
                  <div class="row">

                     <div class="col-md-12">
                        <table class="baalar">
                          <!-- <tr style="text-align: center;">
                            <td colspan="3"><b>Понидельник</b></td>
                          </tr> -->

                          <tr>
                            <th>Предмет</th>
                            <th>Дата</th>
                            <th>Оценка</th>
                          </tr>

        <?php 
         $result = $conn -> query("SELECT DISTINCT * FROM baa INNER JOIN predmet on baa.predmet_aty=predmet.aty WHERE  baa.pupil_aty='{$_SESSION['fio']}' AND baa.klass_aty='{$_SESSION['klass_aty']}' order by date desc");
         if (mysqli_num_rows($result) > 0) 
           {
            $row = mysqli_fetch_array($result);
              do
               {
                  echo ' 
                 
                  <tr>
                    <td>'.$row["predmet_aty"].'</td>
                    <td>'.$row["date"].'</td>
                    <td>'.$row["bal"].'</td>
                  </tr>
                        ';
               }
                while($row = mysqli_fetch_array($result));
              } 
        ?> 

                         <!--  <tr>
                            <td>Русский язык</td>
                            <td>Упражнение №21</td>
                            <td>5</td>
                          </tr>

                          <tr>
                            <td>Тарых</td>
                            <td>Кокон хандыгы</td>
                            <td>4</td>
                          </tr>

                          <tr>
                            <td>Кыргыз тили</td>
                            <td>№34 көнүгүү</td>
                            <td>5</td>
                          </tr>

                          <tr>
                            <td>Химия</td>
                            <td>Кислоталар</td>
                            <td>5</td>
                          </tr> -->
                        </table>
                     </div> 
                  </div>
              </div>
              <!-- /#page-content-wrapper -->
            </div>


            <!-- /#wrapper -->
            <script type="text/javascript">
              $(document).ready(function () {
                var trigger = $('.hamburger'),
                overlay = $('.overlay'),
                isClosed = false;

                trigger.click(function () {
                  hamburger_cross();      
                });

                function hamburger_cross() {

                  if (isClosed == true) {          
                    overlay.hide();
                    trigger.removeClass('is-open');
                    trigger.addClass('is-closed');
                    isClosed = false;
                  } else {   
                    overlay.show();
                    trigger.removeClass('is-closed');
                    trigger.addClass('is-open');
                    isClosed = true;
                  }
                }

                $('[data-toggle="offcanvas"]').click(function () {
                  $('#wrapper').toggleClass('toggled');
                });  
              });
            </script>
          </body>
          </html>
