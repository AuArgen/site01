<?php
    include("connect.php");
    $x = $_POST["x"];
    $res = $conn->query("SELECT * FROM klass");
    if (mysqli_num_rows($res) > 0) {
        echo '
            <label for = "ksl" class = "form-label">Класс:</label>
            <select class="form-select" id="ksl" name="klass" required>
            <option value="'.$x.'">'.$x.'</option>
        ';
        $row = mysqli_fetch_array($res);
        do {
            echo '
            <option value="'.$row["aty"].'">'.$row["aty"].'</option>
            ';
        }while($row = mysqli_fetch_array($res));
        echo'</select>';
    }
?>