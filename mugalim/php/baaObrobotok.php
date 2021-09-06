<?php
    include("connect.php");
    $x = $_POST["x"];
    $y = $_POST["y"];
    // $x = "10(А)-класс";
    // $y = "Информатика";
    $result = $conn->query("SELECT * FROM baa WHERE klass_aty = '$x' AND predmet_aty = '$y'");
    $arr = array();
    $arr2 = array();
    $fio = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $count = 1;
        do {
            $arr2[$row["pupil_aty"]] = $count;
            $fio[] = $row["pupil_aty"];
            $count += 1;
            $a = array();
            $a[] = $row["bal"]; 
            $a[] = $row["klass_aty"]; 
            $a[] = $row["pupil_aty"]; 
            $a[] = $row["date"]; 
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
                $b[] = $row["klass_aty"]; 
                $b[] = $row["fio"]; 
                $b[] = date("Y.m.d"); 
                $arr3[] = $b;
            }
        } while($row = mysqli_fetch_array($result));
    } 
        echo '<tr class="row">
            <th class="col-1 text-center">#</th>
            <th class="col-5 text-center"> Ф.И.О.</th>
            <th class="col-2 text-center"> Балл</th>
            <th class="col-4 text-center"> Сонку балл колюган куну</th>
            </tr>
        ';
    for ($i = 0; $i < sizeof($arr3); $i++) {
        // echo $arr3[$i][4];
        echo '
        <tr class="row">
        <td class="col-1 text-left">'.($i+1).'</td>
        <td class="col-5">'.$arr3[$i][2].' <input type="hidden" name="'.$i.'k0" id="'.$i.'k0"  value="'.$arr3[$i][2].'"></td>
        <td class="col-2 text-center"><input class="form-control text-center" name="'.$i.'k1" maxlength="1" minlength = "1" required type="number" value="'.$arr3[$i][0].'"onchange="obrobotkaChisel(this.value,'.$i.')"></td>
        <td class="col-4 text-center">'.$arr3[$i][3].'</td>
       </tr>
    ';
    }
    echo '<br><p class="text-center"><input type="submit" class="btn btn-primary" value="Сактоо" name="save"></p>';
?>