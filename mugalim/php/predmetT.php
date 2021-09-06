<?php
    include("connect.php");
    $x = $_POST["x"];
    $result = $conn->query("SELECT * FROM teacher WHERE fio = '$x'");
    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo $row["predmet"]."";
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
?>