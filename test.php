<?php 
session_start();

include("include/db_connect.php");
  $klass_id = $_SESSION['klass_id'];
  
  ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
      <meta charset="utf-8">
      <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
      <title>Домашнее задание</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link rel="stylesheet" type="text/css" href="css/jk-style.css">
      <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
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
                    <div class="janylyktar">Домашнее задание</div>
                      <div class="row">
          <div class="col-md-12">
           <form id="padd"> 
             <select style="margin-bottom: 25px;" class="form-control">
               <option>Все</option>
               <option>Выполненные задание</option>
               <option>Не выполненные задание</option>
             </select>
             <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i id="bicon" class="fa fa-check-circle-o" aria-hidden="true"></i>Тест</a>
               </li>
              <!--  <li class="nav-item">
                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i id="bicon" class="fa fa-times-circle-o" aria-hidden="true"></i>Не выполненные</a>
               </li>   -->                 
             </ul>
             <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <?php 
                  
                    $result = $conn->query("SELECT * FROM test INNER JOIN predmet on test.klass_aty='{$_SESSION['klass_aty']}' WHERE test.predmet_aty=predmet.aty order by date desc");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_assoc($result);
                        do
                        {
                          
                            echo '
                 <div class="predmet"><i id="bicon" class="fa fa-book" aria-hidden="true"></i>'.$row['predmet_aty'].'</div>
                 <div class="tapshyrma">
                   <div class="tema"><i style="color: #009688;" id="bicon" class="fa fa-file-text" aria-hidden="true"></i>Тест : <span class="tus"><a href="'.$row["sulka_test"].'">Начать тест</a></span></div>
                   <br>
                   <div class="tema"><i style="color: #009688;" id="bicon" class="fa fa-hourglass-start" aria-hidden="true"></i>Cрок задание :  <span class="tus">'.$row["date"].'</span></div>
                   <br>
                   <div class="tema"><i  style="color: #009688;" id="bicon" class="fa fa-graduation-cap" aria-hidden="true"></i>Преподаватель :  <span class="tus">'.$row["teacher_aty"].'</span></div>
                 </div>

                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
               <a href=""></a>
               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div class="ekinchik">Бул жакта эчнерсе жок Султан</div>
             </div>
             </div>
           </form>
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
