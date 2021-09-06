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
        <script src="https://use.fontawesome.com/addbab05b6.js"></script>
  <link href="index.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
                  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
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
                <?php
                    $res = $conn->query("SELECT * FROM klass");
                    if (mysqli_num_rows($res) > 0) {
                        echo '
                            <label for = "ksl" class = "form-label">Класс:</label>
                            <select class="form-select" id="ksl" name="klass" required>
                            <option value="'.$a[3].'">'.$a[3].'</option>
                        ';
                        $row = mysqli_fetch_array($res);
                        do {
                            if ($a[3] != $row["aty"])
                            echo '
                            <option value="'.$row["aty"].'">'.$row["aty"].'</option>
                            ';
                        }while($row = mysqli_fetch_array($res));
                        echo'</select>';
                    }
?>
<br>
                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_save" id="submit_save" value="Сактоо">
                </p>
                <p align="center"class="col">
                  <a href="pipul.php" class="btn btn-warning"> Артка </a>
                </p>
                <p align="center"class="col">
                  <button type="submit" name="delete" class="btn btn-danger"> X </button>
                </p>
                </div>
    </form>
    <?php
        if(isset($_POST["submit_save"])) {
            $c = array();
            $c[] = $_POST["fio"];
            $c[] = $_POST["login"];
            $c[] = $_POST["pass"];
            $c[] = $_POST["klass"];
                $conn->query("UPDATE pupil SET fio = '$c[0]', login = '$c[1]', password = '$c[2]',klass_aty = '$c[3]' WHERE id = '$x'");
                reload();
        }
        if (isset($_POST["delete"])) {
        $res = $conn->query("SELECT * FROM pupil where id = '$x'");
        $k = "";
        $f = "";
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_array($res);
            do {
                $f = $row["fio"];
                $k = $row["klass_aty"];
                $d = date("Y.m.d");
                $conn->query("INSERT INTO arhiv (fio,status,klass,date) VALUES ('$f','Окуучу','$k','$d')");
            }while($row = mysqli_fetch_array($res));
        }
        $res = $conn->query("DELETE FROM pupil where fio = '$f' AND klass_aty = '$k'");
        $res = $conn->query("DELETE FROM baa where pupil_aty = '$f' AND klass_aty = '$k'");
        $res = $conn->query("DELETE FROM cheirek where pipul_aty = '$f' AND klass_aty = '$k'");
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
       <script src="../script/jquery-1.11.1.min.js"></script>
      </div>
      </section>
</body>
</html>