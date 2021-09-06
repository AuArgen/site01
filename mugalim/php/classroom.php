
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
    <title>Класс</title>
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
      
  
      <h4>Класстар:</h4>
    <?
      if ($_SESSION["status"] == "mug-za") echo '
      <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="aty" placeholder="Класстын аталышы -> 11(A)" maxlength=5 value="" required>
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
    </div> ';
    else echo '                <p class="col-6">
    <a href="../" class="btn btn-danger"> Артка </a>
  </p>';
      if (isset($_POST["submit_news"])) {
        $a = $_POST["aty"]."-класс";
        $conn->query("INSERT INTO klass (aty) VALUES('$a')");
        reload();
      }
      function reload() {
        echo'
        <script>
            function Load() {
                window.location.replace("classroom.php");
            }
            setTimeout(Load,100);
        </script>
        ';
    }

    ?>
    <table class='container-lg table table-striped table-dark table-hover'>
            <tr>
              <th>#</th>
              <th>Аталышы</th>
              <?if ($_SESSION["status"] == "mug-za") {
                echo'<th><button  class="btn btn-danger">X</button></th>';
              }
              ?>
            </tr>
      <?php
      $res = $conn->query("SELECT * FROM klass");
      if (mysqli_num_rows($res) > 0) {
        $pen = "";
        $count = 0;
          $row = mysqli_fetch_array($res);
          do {
            if ($_SESSION["status"] == "mug-za") {
              $pen = '<td><button type="submit" onclick="deleteP('.$row["id"].')" class="btn btn-danger">X</button></td>';  
            }
            $count += 1;
              echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.$row["aty"].'</td>
                          '.$pen.'
                    </tr>
              ';
          }while($row = mysqli_fetch_array($res));
      }
    ?>
    </table>
    <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      function deleteP(x) {
      let y = 2;
      $.ajax({
          url:'./delete.php',
          type:'POST',
          cache:false,
          data:{x,y},
          dataType:'html',
          success: function (data) {
            function Load() {
                window.location.replace("classroom.php");
            }
            setTimeout(Load,100);
          }
      });
    }
    </script>
      </div>
  </section>
  </body>
</html>