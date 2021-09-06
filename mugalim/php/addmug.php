<form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="fio" placeholder="Аты-жөнү" value="" required>
                </div>
                <div class="form-group">
                    <select class="form-select" name="predmet" aria-label="Default select example" required>
                        <option selected>Предметти</option>
                        <?php
                            $res = $conn->query("SELECT * FROM predmet");
                            if (mysqli_num_rows($res) > 0) {
                              $count = 0;
                                $row = mysqli_fetch_array($res);
                                do {
                                  $count += 1;
                                    echo '
                                    <option value='.$row["aty"].'>'.$row["aty"].'</option>
                                    ';
                                }while($row = mysqli_fetch_array($res));
                            }
                        
                        ?>
                    </select>
                </div>
                <br>
                <div class="row">
                <p align="center" class="col">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_news" id="submit_news" value="Сактоо">
                </p>
                <p align="center"class="col">
                  <a href="../" class="btn btn-danger"> Артка </a>
                </p>
                <p align="center"class="col">
                  <a href="./syrsozMug.php" class="btn btn-danger"> Сыр соз </a>
                </p>
                </div>
              </form> 

<div class="modal fade" id="modal-1">
      <div class="modal-dialog">   <!-- modal-sm  размер модального окна -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Маалымат сакталды</h4>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal">Жабуу</button>
          </div>
        </div>
    </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    Include all compiled plugins (below), or include individual files as needed
    <script src="js/bootstrap.js"></script> -->