<?php
    include("./php/connect.php");
    if ($_FILES["file"]["name"] != '') {
        $test = explode(".",$_FILES["file"]["name"]);
        $e = end($test);
        $name = 'kundolukArgen-'.rand(100,100000).'-'.rand(10000,100000000).'A-N'.rand(1000,100000).'.'.$e;
        $l = './img/'.$name;
        move_uploaded_file($_FILES["file"]["tmp_name"],$l);
        session_start();
        $fio = $_SESSION["fio"];
        $res = $conn -> query("SELECT * FROM teacher WHERE fio = '".$fio."'");
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_array($res);
            do {
                if ($row["image"] != "") unlink($row["image"]);
            } while ($row = mysqli_fetch_array($res));
        }
        $conn->query("UPDATE teacher SET image = '$l' WHERE fio = '".$fio."'");
        echo '<img src="'.$l.'" alt="img">';

    }
?>