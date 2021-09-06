<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    $z = $_POST["z"];
    // $x = "1";
    // $y = "Вторник";
    session_start();
    $f = $_SESSION["fio"];
    if ($x == "1") {
        $result = $conn->query("SELECT * FROM rospisanie WHERE teacher_aty = '$f' AND kun_aty = '$y' ORDER BY saat");
        if (mysqli_num_rows($result) > 0) {
                echo '<tr>
                        <th>Саат</th>
                        <th>Класс</th>
                        <th>Отүү</th>
                    </tr>
                ';
                $row = mysqli_fetch_array($result);
                do
                {
                    echo '
                    <tr>
                        <th>'.$row["saat"].'</th>
                        <th>'.$row["klass_aty"].'</th>
                        <th>'.$row["sort"].'</th>
                    </tr>
                    
                    ';
                } while($row = mysqli_fetch_array($result));
            } 
    } else {
        $result = $conn->query("SELECT * FROM rospisanie WHERE klass_aty = '$z' AND kun_aty = '$y' ORDER BY saat");
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
    }
?>