<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    if ($y == "1") {
        $res = $conn->query("DELETE FROM predmet where id = '$x'");
    } else if ($y == "2") {
        $res = $conn->query("DELETE FROM klass where id = '$x'");
    } 
    
?>