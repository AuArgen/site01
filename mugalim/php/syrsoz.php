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
    session_start();
    $l = $_SESSION["log"];
    $p = $_SESSION["pass"];
    $s = $_SESSION["status"];
    $k = "";
    $res = $conn->query("SELECT * FROM teacher WHERE login = '$l' AND pass = '$p' AND status = '$s'");
            if (mysqli_num_rows($res) > 0) {
              $row = mysqli_fetch_array($res);
              do {
                $k = $row["klass"];
              }while($row = mysqli_fetch_array($res));
            }
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename= '$k'logins.xls");
   echo' <table class="container-lg table table-striped table-dark table-hover">
    <tr>
        <th>Аты-жөнү</th>
        <th>Login</th>
        <th>Password</th>
    </tr>';
        $res = $conn->query("SELECT * FROM pupil where klass_aty = '$k' ORDER BY fio");
        if (mysqli_num_rows($res) > 0) {
            $counts = 0;
            $row = mysqli_fetch_array($res);
            do {
                echo'
                    <tr>
                        <td>'.$row["fio"].'</td>
                        <td>'.$row["login"].'</td>
                        <td>'.$row["password"].'</td>
                    </tr>
                ';
            }while($row = mysqli_fetch_array($res));
        }  
echo'</table>';
       
?>
</body>
</html>
