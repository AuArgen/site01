<form method="post">
      <div class="form-group">
            <select class="form-select" id="klass" name="klass">
              <option class="form-control"  value="0">Класс</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM klass ");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option class="form-control" value="'.$row["aty"].'">'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>         <br>
                  </select>
           </div>
  
           <div class="form-group">
            <select class="form-select" id="sort" name="sort">
              <option  value="0">Сабак же ийрим экендигин тандаңыз</option>
              <option value="Сабак">Сабак</option>
              <option value="Ийрим">Ийрим</option>             <br>   
            </select>
           </div>

      <div class="form-group">
            <select class="form-select" id = "kun" name="kun">
              <option  value="0">Өтүлгөн күнү</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM kun");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option value="'.$row["aty"].'">'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?><br>
                  </select>
           </div>

           <div class="form-group">
            <select class="form-select" id="saat" name="saat">
              <option value="0">Өтүлгөн убактысы</option>
                    <?php 
                      for($i= 1; $i <= 12; $i++) {
                            echo '
                                    <option value="'.$i.'">'.$i.' - саат</option>
                            ';                      
                     } 
                    ?><br>
                  </select>
           </div>

        <div class="form-group">
            <select class="form-select" id ="teacher" name="teacher">
              <option  value="0" >Мугалимдин аты-жөнү</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM teacher");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option value="'.$row["fio"].'">'.$row["fio"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
                  <div class="ale">
</div>
           </div> 
           <div class="form-group">
            <select class="form-select" id ="predmet" name="predmet">
              <option  value="0" >Предмет</option>
                    <?php 
                    $result = $conn->query("SELECT * FROM predmet");
                    if (mysqli_num_rows($result) > 0) 
                     {
                        $row = mysqli_fetch_array($result);
                        do
                        {
                            echo '

                                    <option value="'.$row["aty"].'">'.$row["aty"].'</option>
                            ';
                        }
                        while($row = mysqli_fetch_array($result));
                     } 
                    ?>
                  </select>
           </div> 
           <br>
           <table class = "container table table-striped">
           </table>
           <br>
           <div class="row">
                <p align="center" class="col">
                  <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-1" onclick="testSearch3()" id="submit_news" value="Сактоо">
                </p>
                <p align="center" class="col">
                  <a href="../index.php" class="btn btn-danger"> Артка </a>
                </p>
                </div>
              </form>
    </div> 
  	














    <script src="../script/jquery-1.11.1.min.js"></script>
    <script>
      document.querySelector("#kun").style.display = "none";
      document.querySelector("#sort").style.display = "none";
      document.querySelector("#saat").style.display = "none";
      document.querySelector("#teacher").style.display = "none";
      document.querySelector("#predmet").style.display = "none";

      document.querySelector("#klass").onchange = () => {
        document.querySelector("#teacher").value = "0";
        document.querySelector("#saat").value = "0";
        document.querySelector("#kun").value = "0";
        document.querySelector("#sort").value = "0";
        document.querySelector("#sort").style.display = "block";
        document.querySelector(".ale").innerHTML = "";
      }
      document.querySelector("#sort").onchange = () => {
        document.querySelector("#teacher").value = "0";
        document.querySelector("#saat").value = "0";
        document.querySelector("#kun").value = "0";
        document.querySelector("#kun").style.display = "block";
        document.querySelector(".ale").innerHTML = "";
      }
      document.querySelector("#kun").onchange = () => {
        document.querySelector("#teacher").value = "0";
        document.querySelector("#saat").value = "0";
        document.querySelector("#saat").style.display = "block";
        testSearch2(document.querySelector("#klass").value,document.querySelector("#kun").value);
        document.querySelector(".ale").innerHTML = "";
      }
      document.querySelector("#saat").onchange = () => {
        document.querySelector("#teacher").style.display = "block";
        document.querySelector("#teacher").value = '0';
        document.querySelector(".ale").innerHTML = "";
      }
      document.querySelector("#teacher").onchange = () => {
        document.querySelector("#predmet").style.display = "block";
        testSearchs(document.querySelector("#teacher").value);
        ale(document.querySelector("#teacher").value,document.querySelector("#kun").value,document.querySelector("#saat").value);
      }

      function testSearchs(x) {
      $.ajax({
          url:'./predmetT.php',
          type:'POST',
          cache:false,
          data:{x},
          dataType:'html',
          success: function (data) {
            document.querySelector("#predmet").value = data;
          }
      });
    }

    function testSearch2(x,y) {
      $.ajax({
          url:'./rospisanieZa.php',
          type:'POST',
          cache:false,
          data:{x,y},
          dataType:'html',
          success: function (data) {
            document.querySelector(".table-striped").innerHTML = data;
          }
      });
    }
      function testSearch3() {
        var teacher =  document.querySelector("#teacher").value;
        var saat = document.querySelector("#saat").value;
        var kun = document.querySelector("#kun").value;
        var sort = document.querySelector("#sort").value;
        var klass = document.querySelector("#klass").value;
        var predmet = document.querySelector("#predmet").value;

        document.querySelector("#teacher").value = "0";
        document.querySelector("#saat").value = "0";
        document.querySelector("#predmet").value = "0";
        document.querySelector(".ale").innerHTML = "";

      $.ajax({
          url:'./rospisanieSave.php',
          type:'POST',
          cache:false,
          data:{teacher,saat,kun,sort,klass,predmet},
          dataType:'html',
          success: function (data) {
            document.querySelector(".table-striped").innerHTML = data;
          }
      });
    }
    function ale(x,y,z) {
      $.ajax({
          url:'./alert.php',
          type:'POST',
          cache:false,
          data:{x,y,z},
          dataType:'html',
          success: function (data) {
            document.querySelector(".ale").innerHTML = data;
          }
      });
    }
    </script>