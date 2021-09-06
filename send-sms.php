<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
  <title>Написать cообщение</title>
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
                    <div class="soob"><a href="#"> <i id="sms" class="fa fa-envelope" aria-hidden="true"></i>(1) Сообщения</div></a>
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

                <div class="janylyktar">Написать cообщение</div>
             
                  <div class="row">

                   <div class="col-md-12">
                    <form id="padd"> 

                      <div class="form-group">
                        <label for="exampleInputEmail1">Кому ?</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputPassword1">Тема :</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                      </div>


                      <div class="form-group">
                        <label for="exampleTextarea">Напишите текст</label>
                        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputFile">Выберите файл</label>
                        <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                      </div>


                      <button id="jonotuu" type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Отправить</button>

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
