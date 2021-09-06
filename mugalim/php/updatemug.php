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
$res = $conn->query("SELECT * FROM teacher WHERE id = '$x'");
$a = array();
$b = array(
    "mug" => "Мугалим",
    "mug-za" => "Завуч",
    "mug-kl" => "Класс жетекчи жана мугалим",
    "mug-di" => "Директор"
);
if (mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_array($res);
      do {
        $a[] = $row["fio"];
        $a[] = $b[$row["status"]];
        $a[] = $row["predmet"];
        $a[] = $row["login"];
        $a[] = $row["id"];
        $a[] = $row["pass"];
        $a[] = $row["status"];
        $a[] = ($row["klass"] == ""?"Класс":$row["klass"]);
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
      <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <script src="https://use.fontawesome.com/addbab05b6.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
 <link href="index.css" rel="stylesheet">
               <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<link rel="icon" href="../img/favicon.ico" type="image/x-icon">
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
                  <input type="text" class="form-control" name="login" minlength = 6 placeholder="" value="<?echo $a[3];?>" required>
                </div>
                <div class="form-group">
                <label for="pass" class="form-label">Пароль:</label>
                  <input type="text" class="form-control" name="pass" minlength = 6 placeholder="" value="<?echo $a[5];?>" required>
                </div>
                <div class="form-group">
                    <label for="predmet" class="form-label">Предметти:</label>
                    <select class="form-select" id="predmet" name="predmet" aria-label="Default select example" required>
                        <option selected><?echo $a[2];?></option>
                        <?php
                            $res = $conn->query("SELECT * FROM predmet");
                            if (mysqli_num_rows($res) > 0) {
                              $count = 0;
                                $row = mysqli_fetch_array($res);
                                do {
                                  $count += 1;
                                  if ($a[2] != $row["aty"])
                                    echo '
                                    <option value="'.$row["aty"].'">'.$row["aty"].'</option>
                                    ';
                                }while($row = mysqli_fetch_array($res));
                            }
                        
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status" class="form-label">Статус:</label>
                    <select class="form-select" id="status" name="status" aria-label="Default select example" required>
                        <option value="<?echo $a[6]?>"><?echo $a[1];?></option>
                        <?
                           if ($a[6] != "mug" && $a[6] != "mug-di" ) echo '<option value="mug">'.$b["mug"].'</option>';
                           if ($a[6] != "mug-kl" && $a[6] != "mug-di" ) echo '<option value="mug-kl"> '.$b["mug-kl"].'</option>'
                        ?>

                        <?if ($_SESSION["status"] == "mug-di" && $a[6] != "mug-di" ) echo'<option value="mug-za"> '.$b["mug-za"].'</option>';?>
                    </select>
                </div> 
                <input type="hidden" id="sk" value="<?echo $a["7"]?>">
                <input type="hidden" id="kll" value="<?echo $a["6"]?>">
                <div class="form-group kl">
                   
                </div>
                <br>
                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_save" id="submit_save" value="Сактоо">
                </p>
                <p align="center"class="col">
                  <a href="mugalim.php" class="btn btn-warning"> Артка </a>
                </p>
              <? if($a[6] != "mug-di") echo' <p align="center"class="col">
                  <button type="submit" class="btn btn-danger" name="delete">X</button> 
                </p> ';?>
                </div>
    </form>
    <?php
        if(isset($_POST["submit_save"])) {
            $c = array();
            $c[] = $_POST["fio"];
            $c[] = $_POST["login"];
            $c[] = $_POST["pass"];
            $c[] = ($_POST["status"] == ""?$a[6]:$_POST["status"]);
            $c[] = ($_POST["predmet"] == ""?$a[2]:$_POST["predmet"]);
            $c[] = ($c[3] == "mug-kl"?$_POST["klass"]:"");
            if ($c[3] == "mug-kl" && $c[5] == "" || $c[3] == "mug-kl" && $c[5] == "Класс") {
                echo'<script>
                    alert("Класс жетекчиге класс тандалган жок !!!");    
                </script>
                ';
            } else {
                $res = $conn->query("SELECT * FROM teacher WHERE klass = '$c[5]'");
                if (mysqli_num_rows($res) > 0 && $c[3] != "mug-za") {
                    $row = mysqli_fetch_array($res);
                    do {
                        $conn->query("UPDATE teacher SET status = 'mug', klass = '' WHERE id = '".$row["id"]."'");
                    }while($row = mysqli_fetch_array($res));
                }
                if ($c[3] == "mug-za") {
                    $ress = $conn->query("SELECT * FROM teacher WHERE status = 'mug-za'");
                    $ids = 0;
                    if (mysqli_num_rows($ress) > 0) {
                        $row = mysqli_fetch_array($ress);
                        do {
                            $ids = $row["id"];
                        }while($row = mysqli_fetch_array($ress));
                    }
                    $conn->query("UPDATE teacher SET status = 'mug' WHERE id = '$ids'");
                    $conn->query("UPDATE teacher SET fio = '$c[0]', login = '$c[1]', pass = '$c[2]', status = '$c[3]', predmet = '$c[4]', klass = '$c[5]' WHERE id = '$x'");
                } else $conn->query("UPDATE teacher SET fio = '$c[0]', login = '$c[1]', pass = '$c[2]', status = '$c[3]', predmet = '$c[4]', klass = '$c[5]' WHERE id = '$x'");
                reload();
            }
        }
        if (isset($_POST["delete"])) {
            $c = array();
            $c[] = $_POST["fio"];
            $c[] = $_POST["login"];
            $c[] = $_POST["pass"];
            $c[] = ($_POST["status"] == ""?$a[6]:$_POST["status"]);
            $c[] = ($_POST["predmet"] == ""?$a[2]:$_POST["predmet"]);
            $c[] = ($c[3] == "mug-kl"?$_POST["klass"]:"");
            $c[] = date("Y.m.d");
            $conn->query("INSERT INTO arhiv (fio,status,klass,date) VALUES ('$c[0]','Мугалим','---','$c[6]')");
            $rez = $conn->query("DELETE FROM teacher WHERE id = '$x'");  
            
            reload();
        }
        function reload() {
            echo'
            <script>
                function Load() {
                    window.location.replace("mugalim.php");
                }
                setTimeout(Load,100);
            </script>
            ';
        }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src = "../script/index.js"></script>
    </div>
    </section>
</body>
</html>