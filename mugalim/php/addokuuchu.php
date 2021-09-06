<form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="fio" placeholder="Аты-жөнү" value="" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="login" minlength = 6 placeholder="Логин" value="" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="pass" minlength = 6 placeholder="Пароль" value="" required>
                </div>
                <br>
                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_news" id="submit_news" value="Сактоо">
                </p>
                <p align="center"class="col-6">
                  <a href="../" class="btn btn-danger"> Артка </a>
                </p>
    </div>
</form> 

<table class='container-lg table table-striped table-dark table-hover'>
    <tr>
        <th>#</th>
        <th>Аты-жөнү</th>
        <th>Класс</th>
        <th><img src="../img/pen.png" alt="T" width="20"></th>
    </tr>

    <?php
        $res = $conn->query("SELECT * FROM pupil where klass_aty = '$k' ORDER BY fio");
        if (mysqli_num_rows($res) > 0) {
            $counts = 0;
            $row = mysqli_fetch_array($res);
            do {
                $counts +=1;
                echo'
                    <tr>
                        <td>'.$counts.'</td>
                        <td>'.$row["fio"].'</td>
                        <td>'.$row["klass_aty"].'</td>
                        <td><a href="updatePipul.php?id='.$row["id"].'"><img src = "../img/pen.png" width="20" alt="T"/></a></td>
                    </tr>
                ';
            }while($row = mysqli_fetch_array($res));
        }
    ?>    
</table>
