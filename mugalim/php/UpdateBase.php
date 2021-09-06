<?php
    include("connect.php");
    $res = $conn -> query ("SELECT * FROM pupil");
    $uk = array();
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_array($res);
        do {
            // echo substr($row["aty"],0,strlen($row["aty"])-15);
            $k =substr($row["klass_aty"],0,strlen($row["klass_aty"])-15);
            // echo "<h2 style='color:red'>".$row["klass_aty"]." -> ";
            $id = $row['id'];
            $klass = $row['klass_aty'];
            $f = $row["fio"];
            $d = date("Y.m.d");
            if ($k > 10) {
                // echo "Delete </h2>";
                $conn->query("INSERT INTO arhiv (fio,status,klass,date) VALUES ('$f','Окуучу','$klass','$d')");
                $rem = $conn->query("DELETE FROM pupil where id = '$id'");
                $conn->query("UPDATE teacher SET status = 'mug', klass = '' WHERE klass = '$klass'");
            }
            else {
                $k = ($k+1)."".substr($row["klass_aty"],strlen($row["klass_aty"])-15,strlen($row["klass_aty"]));
                $conn->query("UPDATE teacher SET klass = '$k' WHERE klass = '$klass'");
                $conn->query("UPDATE pupil SET klass_aty = '$k' WHERE id = '$id'");
                $uk[] = $k;
            }
        } while($row = mysqli_fetch_array($res));
    }
    $res = $conn->query("DELETE FROM cheirek");
    $res = $conn->query("DELETE FROM rospisanie");
    $res = $conn->query("DELETE FROM baa");
    $res = $conn->query("DELETE FROM tapshyrma");
    $res = $conn->query("DELETE FROM news");
    $res = $conn->query("DELETE FROM test");
    for ($i = 0; $i < sizeof($uk); $i++) {
        $aty = $uk[$i];
        $res = $conn -> query ("SELECT * FROM klass WHERE aty = '$aty'");
        if (mysqli_num_rows($res) < 1) $conn->query("INSERT INTO klass (aty) VALUES ('$aty')");
    }
    echo '
        <div class="alert alert-success" role="alert">
            Мектеп базасы жаны окуу жылыга толугу менен даяр!!!
        </div>
    ';
?>