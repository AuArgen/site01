
<?php
    session_start();
    $l = $_SESSION["log"];
    $p = $_SESSION["pass"];
    $s = $_SESSION["status"];
    $k = "";
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
            } else {
              $row = mysqli_fetch_array($res);
              do {
                $k = $row["klass"];
              }while($row = mysqli_fetch_array($res));
            }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Окуучу</title>
    <link href="index.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/addbab05b6.js"></script>
                  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  </head>
  <body>
    <?include("panel.php");?>
      <section class="home-section">
      <div class="text container-lg">
   <div class="container-lx">
      
  
      <h4> Окуучулар:</h4>
    <?
      if ($_SESSION["status"] == "mug-kl"){
       echo' <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="fio" placeholder="Аты-жөнү" value="" required>
                </div>
                <br>
                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_news" id="submit_news" value="Сактоо">
                </p>
                <p align="center"class="col">
                  <a href="../" class="btn btn-danger"> Артка </a>
                </p>
                <p align="center"class="col">
                  <a href="./syrsoz.php" class="btn btn-danger"> Сыр соз </a>
                </p>
    </div>
</form> 

<table class="container-lg table table-striped table-dark table-hover">
    <tr>
        <th>#</th>
        <th>Аты-жөнү</th>
        <th>Класс</th>
        <th><img src="../img/pen.png" alt="T" width="20"></th>
    </tr>';
        $res = $conn->query("SELECT * FROM pupil where klass_aty = '$k' ORDER BY fio");
        if (mysqli_num_rows($res) > 0) {
            $counts = 0;
            $row = mysqli_fetch_array($res);
            do {
                $counts +=1;
                echo'
                    <tr>
                        <td>'.$counts.'</td>
                        <td>'.$row["fio"].'</td>
                        <td>'.$row["klass_aty"].'</td>
                        <td><a href="updatePipul.php?id='.$row["id"].'"><img src = "../img/pen.png" width="20" alt="T"/></a></td>
                    </tr>
                ';
            }while($row = mysqli_fetch_array($res));
        }  
echo'</table>';
      } 
     
    else echo '                <p class="col-6">
    <a href="../" class="btn btn-danger"> Артка </a>
  </p>';
      if (isset($_POST["submit_news"])) {
        $f = $_POST["fio"];
        $res = $conn->query("SELECT * FROM pupil WHERE klass_aty = '$k'");
        $jh = mysqli_num_rows($res);
        $l = $f;
        $p = $k."-".date("y").''.$jh.''.rand(1,10);
        $conn->query("INSERT INTO pupil (fio,klass_aty,password, login) VALUES('$f','$k','$p','$l')");
        reload();
      }
      function reload() {
        echo'
        <script>
            function Load() {
                window.location.replace("pipul.php");
            }
            setTimeout(Load,1);
        </script>
        ';
    }
    ?>
<hr>
<div class=" container-lg form-group">
<h4 class="text-center">Мектеп окуучулары. <img src = "../img/teamwork.png" width="50" alt="T"></h4>
            <select class="form-select" id="search">
              <option class="form-control">Класс танданыз</option>
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
           <table class='container-lg table two table-striped table-dark table-hover'>
    </table>
</div>
<div class="container-lg">
  <hr>
        <form action="" class="form-control"  method ="post">
          <h4 class="text-center">Предметтик чейрек боюнча класстар аралык рейтинг. <img src = "../img/rei.png" width="60" alt="T"></h4>
        <select class="form-select" id="reiting">
              <option class="form-control">Предметтер ...</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM predmet");
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
                  <select class="form-select" id="cheirek">
                    <option class="form-control" value="0">Чейректер ...</option>
                    <option class="form-control" value="ch_1">1-чейрек</option>
                    <option class="form-control" value="ch_2">2-чейрек</option>
                    <option class="form-control" value="ch_3">3-чейрек</option>
                    <option class="form-control" value="ch_4">4-чейрек</option>
                  </select>
           <br>
           <table class="reiting table two table-striped table-dark table-hover">

           </table>
        </form>
</div>
    <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      document.querySelector("#search").onchange = () => {
        okuuchu(document.querySelector("#search").value );
      }
      document.querySelector("#reiting").onchange = () => {
        document.querySelector("#cheirek").value = "0";
        document.querySelector(".reiting").innerHTML = "";
      }
      document.querySelector("#cheirek").onchange = () => {
        reiting(document.querySelector("#reiting").value,document.querySelector("#cheirek").value);
      }
      function okuuchu(x) {
      let y = 1;
      $.ajax({
          url:'./okuuchu.php',
          type:'POST',
          cache:false,
          data:{x,y},
          dataType:'html',
          success: function (data) {
            document.querySelector(".two").innerHTML = data;
          }
      });
    }
    function reiting(x,y) {
      $.ajax({
          url:'./reiting.php',
          type:'POST',
          cache:false,
          data:{x,y},
          dataType:'html',
          success: function (data) {
            document.querySelector(".reiting").innerHTML = data;
          }
      });
    }
    </script>
</div>
  </section>
  </body>
</html>