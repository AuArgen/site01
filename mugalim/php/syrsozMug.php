<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php  
     include("./connect.php");
     header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename= Teacherlogins.xls");
    echo '
    <table class="container-lx table table-striped table-dark table-hover">
            <tr>
              <td>Ф.И.О</td>
              <td>Login</td>
              <td>Password</td>
            </tr>';
      $res = $conn->query("SELECT * FROM teacher");
      if (mysqli_num_rows($res) > 0) {
        $pen = "";
        $count = 0;
          $row = mysqli_fetch_array($res);
          do {
              echo '<tr>
                          <td>'.$row["fio"].'</td>
                          <td>'.$row["login"].'</td>
                          <td>'.$row["pass"].'</td>
                    </tr>
              ';
          }while($row = mysqli_fetch_array($res));
      }
    echo '</table>';
?> 
</body>
</html>
