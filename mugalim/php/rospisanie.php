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
    <title>Жадыбал</title>
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
      
  
      <h4>Жадыбал</h4>
      <br>
      <?
        if($_SESSION["status"] == "mug-za") include("rospisenieAdd.php");
        else echo'                <p align="center" class="col">
        <a href="../index.php" class="btn btn-danger"> Артка </a>
      </p>';
      ?>
     
<hr>
<form action="" class = "container-lg from-control" method="post">
           <div class="row">
             <p class="col text-center"><input type="radio" onclick="ch(1)" class="form-check-input" checked name="var" id="var"> Менин расписаниям</p>
             <p class="col text-center"><input type="radio" onclick="ch(2)" class="form-check-input" name="var" id="var"> Жалпы расписания</p>
           </div> 
           <div class="row">
            <div class="col form-group">
              <select class="form-select" id = "k">
                <option  value="0">Күн</option>
                      <?php 
                      $result = $conn->query("SELECT * FROM kun");
                      if (mysqli_num_rows($result) > 0) 
                      {
                          $row = mysqli_fetch_array($result);
                          do
                          {
                              echo '

                                      <option value="'.$row["aty"].'">'.$row["aty"].'</option>
                              ';
                          }
                          while($row = mysqli_fetch_array($result));
                      } 
                      ?><br>
                    </select>
            </div>
            <div class=" colform-group">
              <select class="form-select" id="kl">
                <option class="form-control"  value="0">Класс</option>
                      <?php 
                      $result = $conn->query("SELECT * FROM klass");
                      if (mysqli_num_rows($result) > 0) 
                      {
                          $row = mysqli_fetch_array($result);
                          do
                          {
                              echo '

                                      <option class="form-control" value="'.$row["aty"].'">'.$row["aty"].'</option>
                              ';
                          }
                          while($row = mysqli_fetch_array($result));
                      } 
                      ?>         <br>
                  </select>
             </div>
           </div>
           <br>
           <table class='container-lg table table-striped table-dark table-hover'>
    </table>
          </form>
          <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      document.querySelector("#kl").style.display = "none";
      var a = 1;
      function ch(x) {
        a = x;
        document.querySelector(".table").innerHTML="";
        document.querySelector("#k").value="0";
        document.querySelector("#kl").value="0";
        if (a == 1) document.querySelector("#kl").style.display = "none";
      }
      document.querySelector("#k").onchange = () => {
        document.querySelector("#kl").value="0";
        document.querySelector(".table").innerHTML="";
        if (a > 1) document.querySelector("#kl").style.display = "block";
        else {
          testSearch("1",document.querySelector("#k").value,"");
        }
      }
      document.querySelector("#kl").onchange = () => {
          testSearch("2",document.querySelector("#k").value,document.querySelector("#kl").value);
      }
      function testSearch(x,y,z) {
      $.ajax({
          url:'./See.php',
          type:'POST',
          cache:false,
          data:{x,y,z},
          dataType:'html',
          success: function (data) {
            document.querySelector(".table-dark").innerHTML = data;
          }
      });
    }
    </script>
  </div>
  </section>
  </body>
</html>