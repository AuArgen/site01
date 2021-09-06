<?php
    session_start();
    $l = $_SESSION["log"];
    $p = $_SESSION["pass"];
    $s = $_SESSION["status"];
    include("php/connect.php");
    $a = array(
        "mug" => "Мугалим",
        "mug-kl" => "Класс жетекчи",
        "mug-za" => "Завуч",
        "mug-di" => "Директор",
    );

    $res = $conn->query("SELECT * FROM teacher WHERE login = '$l' AND pass = '$p' AND status = '$s'");
            if (mysqli_num_rows($res) <= 0) {
                $row = mysqli_fetch_array($res);
                do {
                    header('Location:./register.php');
                }while($row = mysqli_fetch_array($res));
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?echo $_SESSION["fio"];?></title>
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="style/index.css">
    <!-- Boxicons CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://use.fontawesome.com/addbab05b6.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
<link rel="icon" href="./img/favicon.ico" type="image/x-icon">
   </head>
<body>
  <div class="body">
  <?include("panel.php");?>
  <section class="home-section">
      <div class="text">
        <p style="text-align:center;">№89 Б.Абдрахманова атындагы орто мектеби.</p>
        <hr>
        <ul>
          <li class="alert alert-primary" role="alert"><?
                $j = date("Y");
                $k = date("d");
                $a = date("m");
                if ($a > 8) echo $j.'-'.($j+1).'- окуу жылы.';
                else  echo ($j-1).' - '.$j.'- окуу жылы.';
              ?>
          </li>
          <li class="alert alert-primary" role="alert"><?
              $kuna = array(
                "Monday" =>"Дүйшөмбү",
                "Tuesday" =>"Шейшемби",
                "Wednesday" =>"Шаршемби",
                "Thursday" =>"Бейшенби",
                "Friday" =>"Жума ",
                "Saturday" =>"Ишемби",
                "Sunday" =>"Жекшемби"
              );
              echo 'Күнгө : '.$kuna[date('l')];
            ?>
          </li>
          <li class="alert alert-primary" role="alert"><? echo date("d,m,Y").'-жыл';?></li>
        </ul>
        <ul class="d-flex justify-content-around row">
          <li class="col-sm m-3 alert alert-danger text-center" role="alert">Мугалимдердин жалпы саны: <?
            $res = $conn->query("SELECT * FROM teacher");
            echo mysqli_num_rows($res)."";
          ?> </li>
          <li class="col-sm m-3 alert alert-danger text-center" role="alert">Окуучулардын жалпы саны: <?
            $res = $conn->query("SELECT * FROM pupil");
            echo mysqli_num_rows($res)."";
          ?> </li>
        </ul>
        <div class="img d-flex justify-content-center">
          <img src="./img/school.jpg" style="width:80vw; border-radius:15px;" alt="">
        </div>
      </div>
  </section>
            </div>
</body>
</html>