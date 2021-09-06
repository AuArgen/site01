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
    <title>Архив</title>
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
      <h4>Архив:</h4>
      <br>
      <p class="col-6">
        <button type="button" class="btn btn-outline-success" onclick="yesUpdateBaseDate()">Жаны окуу жылын баштоо</button>
    <a href="../" class="btn btn-danger"> Артка </a>
  </p>
      <form action="" class="form-control" method="post">
            <input class="form-control" type="search" name="search" id="search" placeholder="Аты-жөнү">
            <br>
            <table class='container-lg table two table-striped table-dark table-hover'>
    </table>
      </form>
      <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      document.querySelector("#search").oninput = () => {
        okuuchu(document.querySelector("#search").value );
      }
      function okuuchu(x) {
      let y = 1;
      $.ajax({
          url:'./searchArhiv.php',
          type:'POST',
          cache:false,
          data:{x},
          dataType:'html',
          success: function (data) {
            document.querySelector(".table").innerHTML = data;
          }
      });
    }
    function yesUpdateBaseDate() {
      document.querySelector(".table").innerHTML = `<div class="d-flex justify-content-center "><div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Загрузка...</span>
        </div>
        </div>`;
      let x = "1";
      $.ajax({
          url:'./UpdateBase.php',
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
  