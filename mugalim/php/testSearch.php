<?php
    include("connect.php");
    session_start();
    $f = $_SESSION["fio"];
    $x = $_POST["x"];
  $res = $conn->query("SELECT * FROM test where teacher_aty = '$f' AND klass_aty = '$x'");
  if (mysqli_num_rows($res) > 0) {
    echo '<tr>
    <th>#</th>
    <th>Ссылка</th>
    <th>Куну</th>
    <th>Предмет</th>
  </tr>';
    $count = 0;
      $row = mysqli_fetch_array($res);
      do {
        $count += 1;
          echo '<tr>
                      <td>'.$count.'</td>
                      <td><a href="'.$row["sulka_test"].'">'.substr($row["sulka_test"], 0,10).'...</a></td>
                      <td>'.$row["date"].'</td>
                      <td>'.$row["predmet_aty"].'</td>
                </tr>
          ';
      }while($row = mysqli_fetch_array($res));
  }
?>