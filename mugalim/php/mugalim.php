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
                $row = mysqli_fetch_array($res);
                do {
                    header('Location:../register.php');
                }while($row = mysqli_fetch_array($res));
            }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mugalim</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
 <link href="index.css" rel="stylesheet">
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="https://use.fontawesome.com/addbab05b6.js"></script>
                       <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  </head>
  <body>
    <div class="block"></div>
    <?include("panel.php");?>
      <section class="home-section">
      <div class="text container">
   <div class="container">
   
    <h4>Мугалимдер</h4>
    <?php 
      if ($_SESSION["status"] == "mug-di" || $_SESSION["status"] == "mug-za") {
        include("addmug.php"); 
        if (isset($_POST["submit_news"])) 
        {
          $f = $_POST["fio"] ;
          $s = "mug";
          $l = $_POST["fio"] ;
          $p = 'mug-'.rand(1000,10000);
          $t = $_POST["predmet"] ;
            $conn->query("INSERT INTO teacher(fio,login,status,pass,predmet,klass,image)
              VALUES(
              '$f',
              '$l',
              '$s',
              '$p',
              '$t',
              '',
              ''
            )");
            reload();
        }
      }else echo '             <br>   <p class="col-6">
      <a href="../" class="btn btn-danger"> Артка </a>
    </p>';
    function reload() {
      echo'
      <script>
          function Load() {
              window.location.replace("mugalim.php");
          }
          setTimeout(Load,1);
      </script>
      ';
  }
    ?>
    <table class='container-lx table table-striped table-dark table-hover'>
            <tr>
              <td>#</td>
              <td>Ф.И.О</td>
              <td>Предмет</td>
              <?if ($_SESSION["status"] == "mug-di" || $_SESSION["status"] == "mug-za") {
                echo'<td><img src="../img/pen.png" alt = "T" width = "18"></td>';
              }
              ?>
            </tr>
      <?php
      $res = $conn->query("SELECT * FROM teacher");
      if (mysqli_num_rows($res) > 0) {
        $pen = "";
        $count = 0;
          $row = mysqli_fetch_array($res);
          do {
            if ($_SESSION["status"] == "mug-di" || $_SESSION["status"] == "mug-za") {
              $pen = '<td><button style ="cursor:pointer; border:none; background:none"><a href="updatemug.php?id='.$row["id"].'"><img src="../img/pen.png" alt = "T" width = "18"></a></button></td>';  
            }
            $count += 1;
              echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.$row["fio"].'</td>
                          <td>'.$row["predmet"].'</td>
                          '.$pen.'
                    </tr>
              ';
          }while($row = mysqli_fetch_array($res));
      }
    ?>
    </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <!-- <script>
        function update(x) {
          $.ajax({
              url:'updatemug.php',
              type:'POST',
              cache:false,
              data:{x},
              dataType:'html',
              success: function (data) {
                  document.querySelector(".block").innerHTML = data;
                  document.querySelector(".block").classList.toggle("active");
              }
          });
        }
      </script> -->
      </div>
  </section>
  </body>
</html>