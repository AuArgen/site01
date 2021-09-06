
<?php
    session_start();
    $l = $_SESSION["log"];
    $p = $_SESSION["pass"];
    $s = $_SESSION["status"];
    include("connect.php");
    $res = $conn->query("SELECT * FROM teacher WHERE login = '$l' AND pass = '$p' AND status = '$s'");
            if (mysqli_num_rows($res) <= 0) {
                    header('Location:../register.php');
            }
              $a = array(
        "mug" => "Мугалим",
        "mug-kl" => "Класс жетекчи",
        "mug-za" => "Завуч",
        "mug-di" => "Директор",
    );
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Чейрек</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    <!-- <link href="../style/Style.css" rel="stylesheet"> -->
      <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <script src="https://use.fontawesome.com/addbab05b6.js"></script>
                       <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  </head>
  <body>
    <?include("panel.php");?>  <section class="home-section">
      <div class="text container-lg">

   <div class="container-lg">
      
      <h4>Чейрек:</h4>
      <div class=" container-lg form-group">
      <form action="" method = "post">
            <select class="form-select" id="search" name="search">
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
           <select class="form-select" id="predmet" name="predmet">
              <option class="form-control" value = "pr">Предмет</option>
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
                  <br>
                  <p align="center" class="col">
                  <a href="../index.php" class="btn btn-danger"> Артка </a>
                </p>
           <br>
                        <table class='container-lg table table-striped table-dark table-hover'>
                    </table>
                    
           </form>
      </div>
      <?php
                      
        if(isset($_POST["save"])) {
          $k = $_POST["search"];
          $f = $_SESSION["fio"];
          $res =$conn->query("SELECT * FROM pupil WHERE klass_aty = '".$k."'");
          $n = mysqli_num_rows($res);
          echo'<pre>';
          for ($i = 0; $i < $n; $i++) {
            $a = array();
            $a[] = $_POST["predmet"]; 
            $a[] = $_POST[$i."k0"]; 
            $a[] = $_POST[$i."k1"]; 
            $a[] = $_POST[$i."k2"]; 
            $a[] = $_POST[$i."k3"]; 
            $a[] = $_POST[$i."k4"];
            $res =$conn->query("SELECT * FROM cheirek WHERE klass_aty = '$k' AND pipul_aty = '$a[1]' AND predmet_aty = '$a[0]'");
            if (mysqli_num_rows($res)>0) {
              $conn->query("UPDATE cheirek SET ch_1 = '$a[2]',ch_2 = '$a[3]',ch_3 = '$a[4]',ch_4 = '$a[5]', predmet_aty='$a[0]', pipul_aty='$a[1]',klass_aty='$k', teacher_aty='$f' WHERE klass_aty = '$k' AND pipul_aty = '$a[1]' AND predmet_aty = '$a[0]'");
            } else {
              $conn->query("INSERT INTO cheirek (ch_1,ch_2,ch_3,ch_4, klass_aty,pipul_aty, teacher_aty,predmet_aty) VALUES (
                '$a[2]',
                '$a[3]',
                '$a[4]',
                '$a[5]',
                '$k',
                '$a[1]',
                '$f',
                '$a[0]'
              )");
            }
          }
          echo"<script>
          alert('Маалымат сакталды!!!');
        </script>";
          reload();
        }
        function reload() {
          echo'
          <script>
              function Load() {
                  window.location.replace("cheirek.php");
              }
              setTimeout(Load,1);
          </script>
          ';
      }             
      ?>
    <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      document.querySelector("#search").onchange = () => {
        document.querySelector("#predmet").value = "pr";
        document.querySelector(".table").innerHTML = "";
      }
       document.querySelector("#predmet").onchange = () => {
        testSearch(document.querySelector("#search").value,document.querySelector("#predmet").value );
      }
      function testSearch(x,y) {
      $.ajax({
          url:'./cheirekObrobotok.php',
          type:'POST',
          cache:false,
          data:{x,y},
          dataType:'html',
          success: function (data) {
            document.querySelector(".table").innerHTML = data;
          }
      });
    }
    function obrobotkaChisel(x,y,z) {
      let h = y+"k0";
      let s = document.getElementById(h).value;
      if (+x > 5) alert(s+"тин "+z+"- чейрек баасы 5 тен жогору болуп калды {"+x+"}!!!");
    }
    </script>
    </div>
  </section>
  </body>
</html>