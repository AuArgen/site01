<?php
  include("connect.php");
  $k = $_POST["klass"];
  $s = $_POST["sort"];
  $n = $_POST["kun"];
  $a = $_POST["saat"];
  $t = $_POST["teacher"];
  $p = $_POST["predmet"];
  $res = $conn->query("SELECT * FROM rospisanie WHERE saat = '$a' AND kun_aty = '$n'");
  $id = 0;
  if (mysqli_num_rows($res)) {
      $row = mysqli_fetch_array($res);
      do {
          $id = $row["id"];
      } while($row = mysqli_fetch_array($res));
  }
  $m = mysqli_num_rows($res);
  if ($m) {
  $conn->query("UPDATE rospisanie SET teacher_aty = '$t', predmet_aty = '$p', saat = '$a', kun_aty = '$n', klass_aty = '$k', sort = '$s' WHERE id = '$id'");
  } else {
  $conn->query("INSERT INTO rospisanie (teacher_aty,predmet_aty,saat,kun_aty,klass_aty,sort) VALUES ('$t','$p','$a','$n','$k','$s')");
  }

  $result = $conn->query("SELECT * FROM rospisanie WHERE klass_aty = '$k' AND kun_aty = '$n' ORDER BY saat");
    if (mysqli_num_rows($result) > 0) {
        echo '<tr>
                <th>Саат</th>
                <th>Сабак</th>
                <th>Мугалим</th>
            </tr>
        ';
        $row = mysqli_fetch_array($result);
        do
        {
            echo '
            <tr>
                <th>'.$row["saat"].'</th>
                <th>'.$row["predmet_aty"].'</th>
                <th>'.$row["teacher_aty"].'</th>
            </tr>
            
            ';
        } while($row = mysqli_fetch_array($result));
    } 



?>