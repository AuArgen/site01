
<?php
include("include/db_connect.php");  
if ($_POST["submit_news"]) 
{
  if ($_POST["fio"] == "" || $_POST["login"] == ""  ||$_POST["pass"] == "") 
  {
    $message = "<p id='form-error'>Заполните все поля!</p>";
  }
  else
  {
    $conn->query("INSERT INTO teacher(fio,login,pass)
      VALUES(
      '".$_POST["fio"]."',
      '".$_POST["login"]."',
      '".$_POST["pass"]."'
    )");

    $message = "<p id='form-success'>Новость добавлена!</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sultan</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  <link  href="css/fontawesome.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 
   <div class="container">
  
      <h1>Мугалим</h1>
   
      <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="fio" placeholder="Аты-жөнү" value="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="login" placeholder="Логин" value="">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="pass" placeholder="Пароль" value="">
                </div>
                <p align="center">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_news" id="submit_news" value="Сактоо">
                </p>
                <p align="center">
                  <a href="index.php" class="btn btn-primary"> Артка </a>
                </p>
              </form>
    </div> 
  	


<div class="modal fade" id="modal-1">
      <div class="modal-dialog">   <!-- modal-sm  размер модального окна -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Маалымат сакталды</h4>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Жабуу</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>