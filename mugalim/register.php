<?php
    session_start();
    $_SESSION["log"] = ($_SESSION["log"]?$_SESSION["log"]:"*******************************************************");
    $_SESSION["pass"] = ($_SESSION["pass"]?$_SESSION["pass"]:"*******************************************");
    $_SESSION["status"] = ($_SESSION["status"]?$_SESSION["status"]:"**********************************************");
        $l = $_SESSION["log"];
        $p = $_SESSION["pass"];
        $s = $_SESSION["status"];
        include("php/connect.php");
        $res = $conn->query("SELECT * FROM teacher WHERE login = '$l' AND pass = '$p' AND status = '$s'");
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_array($res);
                    do {
                        header('Location:index.php');
                    }while($row = mysqli_fetch_array($res));
                }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
<link rel="icon" href="./img/favicon.ico" type="image/x-icon">
</head>
<body>
	<img class="wave" src="imgs/wave.png">
	<div class="container">
		<div class="img">
			<img src="imgs/bg.svg">
		</div>
		<div class="login-content">
			<form action="" method="post">
				<img src="imgs/avatar.svg">
				<h2 class="title">Кош келиниз.</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Логин</h5>
           		   		<input type="text" name="log" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Пароль</h5>
           		    	<input type="password" name="pass" class="input">
            	   </div>
            	</div>
            	<input type="submit" name = "submit" class="btn" value="Кируу">
            </form>
        </div>
    </div>
	<?php
            if(isset($_POST["submit"])) {
                $l = $_POST["log"];
                $p = $_POST["pass"];
                $res = $conn->query("SELECT * FROM teacher WHERE login = '$l' AND pass = '$p'");
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_array($res);
                    do {
                        header('Location:index.php');
                        // session_start();
                        $_SESSION["log"] = $l;
                        $_SESSION["pass"] = $p;
                        $_SESSION["status"] = $row["status"];
                        $_SESSION["fio"] = $row["fio"];
                        $_SESSION["image"] = $row["image"];
                    }while($row = mysqli_fetch_array($res));
                }else {
                    echo'
                        <script>
                            alert("Логин или пароль не правильный!!!");
                        </script>
                    ';
                }
            }
        ?>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
