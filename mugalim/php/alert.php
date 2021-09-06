<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    $z = $_POST["z"];
    $res = $conn -> query("SELECT * FROM rospisanie WHERE teacher_aty = '$x' AND kun_aty = '$y' AND saat = '$z'");
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_array($res);
        do {
            echo '
            <div class="alert alert-danger" role="alert">
             '.$x.' мугалимдин '.$y.' куну '.$z.' - саатта '.$row["klass_aty"].'ка сабагы бар экен.
            </div>
            ';
        } while($row = mysqli_fetch_array($res));
    }
?>