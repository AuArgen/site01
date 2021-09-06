<?php
    include("connect.php");
    $x = $_POST["x"];
    $result = $conn->query("SELECT * FROM arhiv WHERE fio LIKE '%$x%' LIMIT 50");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo'
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Ф.И.О.</th>
                <th class="text-center">Статус</th>
                <th class="text-center">Дата удаление</th>
            </tr>
        ';
        $count = 0;
        do {
            $count++;
            echo '
            <tr>
                <td class="text-center">'.$count.'</td>
                <td class="">'.$row["fio"].'</td>
                <td class="text-center">'.$row["status"].'</td>
                <td class="text-center">'.$row["date"].'</td>
            </tr>
            ';
        } while($row = mysqli_fetch_array($result));
    } else echo "<tr><td>No database!!!</td></tr>";
?>