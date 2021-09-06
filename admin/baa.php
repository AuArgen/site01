
<?php
include("include/db_connect.php");  
if ($_POST["submit_news"]) 
{
  if ($_POST["fio_pipul"] == "" || $_POST["pred_aty"] == "" || $_POST["klass_aty"] == ""  ||$_POST["baa"] == "") 
  {
    $message = "<p id='form-error'>Заполните все поля!</p>";
  }
  else
  {
    $conn->query("INSERT INTO baa(pupil_aty,predmet_aty,klass_aty,bal,date)
      VALUES(
      '".$_POST["fio_pipul"]."',
      '".$_POST["pred_aty"]."',
      '".$_POST["klass_aty"]."',
      '".$_POST["baa"]."',
      NOW()
    )");

    $message = "<p id='form-success'>Новость добавлена!</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Sultan</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  <link  href="css/fontawesome.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

 <script src="js/jquery-1.12.1.min.js"></script>
 <script>
   $(document).ready(function(){
     $('#klass_name').on('change', function(){
        var aty = $(this).val();
        if (aty){
        $.post('ajaxData.php',{klass_name:aty}, function (data){
        $('#fio_pipul').html(data);
        //console.log(data);
        });
        }
        else{
            $('#state').html('<option value="">Окуучунун</option>');
            
        }
    });
  });
 </script>
  </head>
   <div class="container">
  
      <h1>Балоо</h1>
   
      <form method="post">

          <div class="form-group">
            <select class="form-control" name="klass_aty" id="klass_name">
              <option class="form-control">Класс</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM klass");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option value="'.$row["aty"].'" class="form-control">'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
           </div>
             
          <div class="form-group">
            <select class="form-control" name="fio_pipul" id="fio_pipul">
              <option>Окуучунун аты-жөнү</option>
                   
                  </select>
           </div>



           <div class="form-group">
            <select class="form-control" name="pred_aty">
              <option>Предметтин аталышы</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM predmet");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option>'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
           </div>


         
                <div class="form-group">
                  <input type="text" class="form-control" name="baa" placeholder="Баа" value="">
                </div>
                <p align="center">
                  <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" name="submit_news" id="submit_news" value="Сактоо">
                </p>
                <p align="center">
                  <a href="index.php" class="btn btn-primary"> Артка </a>
                </p>
              </form>
    </div> 
  	


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



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
  </body>
</html>