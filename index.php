<?php 
session_start(); 
include("include/db_connect.php");
if ($_POST["submit"]) 
{
   $login = $_POST["username"];
   $pass = $_POST["password"];
   $msgerror="";
   if($login && $pass)
   {
      $result = $conn->query("SELECT * FROM pupil WHERE login = '$login' AND password = '$pass'");
      if (mysqli_num_rows($result) > 0) 
      {
         $row = mysqli_fetch_array($result);
         $_SESSION['auth_admin'] = 'yes_auth';
         $_SESSION['id'] = $row['id'];
         $_SESSION['fio'] = $row['fio'];
         $_SESSION['klass_aty'] = $row['klass_aty'];
         
         header("Location: forma.php");
      }else
      {
         $msgerror = "Логин же Пароль туура эмес терилген.";
      }
   }else
   {
      $msgerror = "Жолчолордун баарын толтурунуз!";
   }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/bootstrap.css" rel="stylesheet">
     <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
  <!--  <script src="js/java.js"></script> -->
<link rel="stylesheet" type="text/css" href="style.css">
    <title>Күндөлүк</title>
</head>
<body>
<div class="container">
    <div class="login-container">
            <div id="output"></div>
            <div class="avatar"></div>
            <div class="form-box">
                <? 
      if($msgerror) {
         echo '<p id="msgerror">'.$msgerror.'</p>';
      } 
      ?>
        <form method="post">
                    <input name="username" type="text" placeholder="Логин">
                    <input name="password" type="password" placeholder="Пароль">
               <!--  -->
                  <input id="pasname" type="submit" name="submit" value="Кийинки">
                   <!-- <button class="btn btn-info btn-block login" type="submit" name="submit">Вход</button>-->
                </form>
            </div>
        </div> 
</div>
</body>
</html>