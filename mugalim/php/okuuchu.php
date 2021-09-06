<?php
    include("connect.php");
    session_start();
    $f = $_SESSION["fio"];
    $x = $_POST["x"];
  $res = $conn->query("SELECT * FROM pupil where klass_aty = '$x' ORDER BY fio ");
  $r = $conn->query("SELECT fio FROM teacher where klass = '$x'");
  $rr = "";
  if (mysqli_num_rows($r) > 0) {
      $row = mysqli_fetch_array($r);
      do {
       $rr = $row["fio"];
      }while($row = mysqli_fetch_array($r));
  }
  $re = $conn->query("SELECT * FROM pupil");
  echo'
    <tr>
      <td class="text-center">'.mysqli_num_rows($re).'/'.mysqli_num_rows($res).'</td>
    </tr>
  ';
  if (mysqli_num_rows($res) > 0) {
    echo '
    <tr>
    <th>#</th>
    <th>Ф.И.О.</th>
    <th>Мугалими</th>
    '.($_SESSION["status"] == "mug-za"?'<th><img src="../img/pen.png" alt="T" width="20"/></th>':"").'
  </tr>';
    $count = 0;
      $row = mysqli_fetch_array($res);
      do {
        $count += 1;
          echo '<tr>
                      <td>'.$count.'</td>
                      <td>'.$row["fio"].'</td>
                      <td>'.$rr.'</td>
                      '.($_SESSION["status"] == "mug-za"?'<th><a href = "updatePipulZa.php?id='.$row["id"].'"><img src="../img/pen.png" alt="T" width="20"/></a></th>':"").'
                </tr>
          ';
      }while($row = mysqli_fetch_array($res));
  }
?>