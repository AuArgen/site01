<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    $result = $conn->query("SELECT * FROM teacher");
    $fio = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        do {
            $fio[] = $row["fio"];
        } while($row = mysqli_fetch_array($result));
    } 






?>