<?php
  include("connect.php");
  $x = $_POST["x"];
  $y = $_POST["y"];
$result = $conn->query("SELECT * FROM rospisanie WHERE klass_aty = '$x' AND kun_aty = '$y' ORDER BY saat");
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