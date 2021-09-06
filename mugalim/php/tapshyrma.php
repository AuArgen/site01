<?php
    session_start();
    $l = $_SESSION["log"];
    $p = $_SESSION["pass"];
    $s = $_SESSION["status"];
    include("connect.php");
        $a = array(
        "mug" => "Мугалим",
        "mug-kl" => "Класс жетекчи",
        "mug-za" => "Завуч",
        "mug-di" => "Директор",
    );
    $res = $conn->query("SELECT * FROM teacher WHERE login = '$l' AND pass = '$p' AND status = '$s'");
            if (mysqli_num_rows($res) <= 0) {
                    header('Location:../register.php');
            }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тапшырма</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link href="index.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="https://use.fontawesome.com/addbab05b6.js"></script>
                       <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  </head>
  <body>
    <?include("panel.php");?>
      <section class="home-section">
      <div class="text container-lg">
   <div class="container-lg">
      
      <h4>Тапшырма</h4>
   
      <form method="post">
             

              <div class="form-group">
            <select class="form-select" name="klass_aty">
              <option class="form-control">Класс</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM klass");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option class="form-control">'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
           </div>
         <div class="form-group">
            <select class="form-select" name="predmet_aty">
              <option>Предметтин аталышы</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM predmet",$link);
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option>'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
           </div>

             <div class="form-group">
                  <input type="text" class="form-control" name="tema" placeholder="Сабактын темасы" value="" required>
                </div>
           
            <div class="form-group">
                  <input type="text" class="form-control" name="sulka" placeholder="Видео же онлайн сабактын ссылкасы" value="">
                </div>
<br>

                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_news" id="submit_news" value="Сактоо">
                </p>
                <p align="center" class="col">
                  <a href="../index.php" class="btn btn-danger"> Артка </a>
                </p>
                </div>
              </form>
    </div> 
  	
<?
  if(isset($_POST["submit_news"])) {
    $k = $_POST["klass_aty"];
    $f = $_SESSION["fio"];
    $p = $_POST["predmet_aty"];
    $t = $_POST["tema"];
    $s = $_POST["sulka"];
    $conn->query("INSERT INTO tapshyrma(klass_aty,teacher_aty,predmet_aty,tema,sulka,date)
      VALUES( '$k','$f','$p','$t','$s',NOW())");
          reload();
        }
        function reload() {
          echo'
          <script>
              function Load() {
                  window.location.replace("./tapshyrma.php");
              }
              setTimeout(Load,1);
          </script>
          ';
      }
?>
<hr>
<div class=" container-lg form-group">
            <select class="form-select" id="search">
              <option class="form-control">Класс</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM klass");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option class="form-control" value="'.$row["aty"].'" >'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
           
           <br>
           <table class='container-lg table table-striped table-dark table-hover'>
                    </table>
                    </div>

    <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      document.querySelector("#search").onchange = () => {
        testSearch(document.querySelector("#search").value );
      }
      function testSearch(x) {
      $.ajax({
          url:'./homeWork.php',
          type:'POST',
          cache:false,
          data:{x},
          dataType:'html',
          success: function (data) {
            document.querySelector(".table").innerHTML = data;
          }
      });
    }
    </script>
</div>
  </section>

  </body>
</html>