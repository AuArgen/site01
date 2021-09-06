<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    $mas = array();
    $res = $conn->query("SELECT * FROM klass");
    if (mysqli_num_rows($res)) {
        $row = mysqli_fetch_array($res);
        do {
            $mas[] = $row["aty"];
        } while ($row = mysqli_fetch_array($res));
    }
echo'
    <tr class="row">
        <th class="col-1">#</th>
        <th class="col-2">Класс</th>
        <th class="col-7">Диаграмма</th>
        <th class="col-2">Саны</th>
    </tr>
';
    $mas2 = array();
    $mas3 = array();
    for ($i = 0; $i < sizeof($mas); $i++) {
        $name = $mas[$i]."";
        $res = $conn->query("SELECT * FROM cheirek WHERE predmet_aty = '$x' AND klass_aty='$name'");
        $n = mysqli_num_rows($res) * 5;
        $a = 0;
        if (mysqli_num_rows($res)) {
            $row = mysqli_fetch_array($res);
            do {
                $a += $row[$y];
            } while ($row = mysqli_fetch_array($res));
        }
        $r = 0.0;
        $r = ($n > 0?($a*100)/$n:$r);
        $mas2[] = $r;
        $mas3[] = $r;
    }
    sort($mas2);
    $count = 0;
    for ($i = sizeof($mas2) - 1; $i >= 0; $i--) {
            for ($j = 0; $j < sizeof($mas3); $j++) {
                if ($mas2[$i] == $mas3[$j]) {
                    $count ++;
                    $r = $mas2[$i];
                    echo'
                    <tr class="row">
                        <th class="col-1">'.$count.'</th>
                        <th class="col-2">'.$mas[$j].'</th>
                        <th class="col-7"><div style="height:20px; background:blue; border-radius:20px; width:'.$mas3[$j].'%;"><div></th>
                        <th class="col-2">'.substr($mas3[$j],0,5).'%</th>
                    </tr>
                    ';
                    $mas3[$j] = 50000;
                    break;
                }
        }
    }
?>