
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
    <title>Жанылык</title>
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
      
  
      <h4>Жанылык</h4>
   
      <form method="post">
                <div class="form-group d-flex justify-content-center">
                  <textarea style="height: 300px; width:80%" class="form-control" type="text" placeholder="Жанылык ..." name="news"></textarea>
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
    <hr>
    <h5>
    <p class="text-center">
      Акыркы жанылыктар
    </p>
    </h5>
    <div class = "news">
      <ul>
          <?
              $res = $conn->query("SELECT * FROM news ORDER BY id DESC LIMIT 10");
              if (mysqli_num_rows($res)) {
                $row = mysqli_fetch_array($res);
                do {
                    echo '
                      <li class="alert alert-success" role="alert">
                        <p class="float-start">
                          '.$row["news_text"].'
                        <p>
                        <p class="float-end">
                          '.$row["date"].'
                        </p>
                        <br>
                      </li>
                    ';
                } while($row = mysqli_fetch_array($res));
              }
          ?>
      </ul>
    </div>
  <?
    if (isset($_POST["submit_news"])) {
      $n = $_POST["news"];
      $d = date("Y.m.d");
      $conn->query("INSERT INTO news (news_text,date) VALUES('$n','$d')");
      reload();
    }
    function reload() {
      echo'
      <script>
          function Load() {
              window.location.replace("./news.php");
          }
          setTimeout(Load,1);
      </script>
      ';
  }
  ?>
</div>
  </section>
  </body>
</html>