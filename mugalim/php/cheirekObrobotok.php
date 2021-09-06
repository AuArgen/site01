<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    // $x = "10(А)-класс";
    // $y = "Информатика";
    $result = $conn->query("SELECT * FROM cheirek WHERE klass_aty = '$x' AND predmet_aty = '$y'");
    $arr = array();
    $arr2 = array();
    $fio = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $count = 1;
        do {
            $arr2[$row["pipul_aty"]] = $count;
            $fio[] = $row["pipul_aty"];
            $count += 1;
            $a = array();
            $a[] = $row["ch_1"]; 
            $a[] = $row["ch_2"]; 
            $a[] = $row["ch_3"]; 
            $a[] = $row["ch_4"]; 
            $a[] = $row["klass_aty"]; 
            $a[] = $row["pipul_aty"]; 
            $arr[] = $a;
        } while($row = mysqli_fetch_array($result));
    } 
    $arr3 = array();
    $result = $conn->query("SELECT * FROM pupil WHERE klass_aty = '$x' ORDER BY fio");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        do {
            $r = 0;
            for ($i = 0; $i < sizeof($fio); $i++) {
                if ($fio[$i] == $row["fio"]) $r++;
            }
            if ($r) {
                $arr3[] = $arr[$arr2[$row["fio"]]-1];
            } else {
                $b = array();
                $b[] = 0; 
                $b[] = 0; 
                $b[] = 0; 
                $b[] = 0; 
                $b[] = $row["klass_aty"]; 
                $b[] = $row["fio"]; 
                $arr3[] = $b;
            }
        } while($row = mysqli_fetch_array($result));
    } 
        echo '<tr class="row">
            <th class="col-1">#</th>
            <th class="col-3">Ф.И.О.</th>
            <th class="col-2">1-чейрек</th>
            <th class="col-2">2-чейрек</th>
            <th class="col-2">3-чейрек</th>
            <th class="col-2">4-чейрек</th>
            </tr>
        ';
    for ($i = 0; $i < sizeof($arr3); $i++) {
        // echo $arr3[$i][4];
        echo '
        <tr class="row">
        <td class="col-1">'.($i+1).'</td>
        <td class="col-3">'.$arr3[$i][5].' <input type="hidden" name="'.$i.'k0" class = "'.$i.'k0" value="'.$arr3[$i][5].'"><input style="display:none;" type="text" name="'.$i.'k0" id = "'.$i.'k0" value="'.$arr3[$i][5].'"></td>
        <td class="col-2"><input class="form-control '.$i.'k1" name="'.$i.'k1" maxlength="1" minlength = "1" required type="number" value="'.$arr3[$i][0].'" onchange="obrobotkaChisel(this.value,'.$i.',1)"></td>
        <td class="col-2"><input class="form-control '.$i.'k2" name="'.$i.'k2" maxlength="1" minlength = "1" required type="number" value="'.$arr3[$i][1].'" onchange="obrobotkaChisel(this.value",'.$i.',2)"></td>
        <td class="col-2"><input class="form-control '.$i.'k3" name="'.$i.'k3" maxlength="1" minlength = "1" required type="number" value="'.$arr3[$i][2].'" onchange="obrobotkaChisel(this.value,'.$i.',3)"></td>
        <td class="col-2"><input class="form-control '.$i.'k4" name="'.$i.'k4" maxlength="1" minlength = "1" required type="number" value="'.$arr3[$i][3].'" onchange="obrobotkaChisel(this.value,'.$i.',4)"></td>
        </tr>
    ';
    }
    echo '<p class="text-center"><input type="submit" class="btn btn-primary" value="Сактоо" name="save"></p>';
?>