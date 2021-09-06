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
$x = $_GET["id"];
include("connect.php");
$res = $conn->query("SELECT * FROM pupil WHERE id = '$x'");
$a = array();
if (mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_array($res);
      do {
        $a[] = $row["fio"];
        $a[] = $row["login"];
        $a[] = $row["password"];
        $a[] = $row["klass_aty"];
      }while($row = mysqli_fetch_array($res));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="index.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/addbab05b6.js"></script>
                  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  </head>
  <body>
    <?include("panel.php");?>
      <section class="home-section container-lx">
      <div class="text container-lg">
    <form class="container form-control bg-info" method="post">
                <div class="form-group">
                    <label for="fio" class="form-label">Аты жөнү:</label>
                  <input type="text" class="form-control" name="fio" placeholder="" value="<?echo $a[0];?>" required>
                </div>
                <div class="form-group">
                <label for="login" class="form-label">Логин:</label>
                  <input type="text" class="form-control" name="login" minlength = 6 placeholder="" value="<?echo $a[1];?>" required>
                </div>
                <div class="form-group">
                <label for="pass" class="form-label">Пароль:</label>
                  <input type="text" class="form-control" name="pass" minlength = 6 placeholder="" value="<?echo $a[2];?>" required>
                </div>
                <br>
                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_save" id="submit_save" value="Сактоо">
                </p>
                <p align="center"class="col">
                  <a href="pipul.php" class="btn btn-warning"> Артка </a>
                </p>
                </div>
    </form>
    <?php
        if(isset($_POST["submit_save"])) {
            $c = array();
            $c[] = $_POST["fio"];
            $c[] = $_POST["login"];
            $c[] = $_POST["pass"];
                $conn->query("UPDATE pupil SET fio = '$c[0]', login = '$c[1]', password = '$c[2]',klass_aty = '$a[3]' WHERE id = '$x'");
                reload();
        }
        function reload() {
            echo'
            <script>
                function Load() {
                    window.location.replace("pipul.php");
                }
                setTimeout(Load,100);
            </script>
            ';
        }
    ?>
    </div>
      </section>
</body>
</html>