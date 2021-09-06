  <div class="menu">
    <div class="logo-details">
      <i><img src="./img/k.png" width="50" style="border-radius:50%" alt=""></i>
        <div class="logo_name">Күндөлүк</div>
        <i class="menu_bur"></i>
    </div>
 </div>
 <div class="sidebar">
    <div class="logo-details">
      <i class='kundoluk'></i>
        <div class="logo_name">Күндөлүк</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <div class = "scroll" <?if ($_SESSION["status"] == "mug-di") echo 'style="height:80vh"';?>>
    <ul class="nav-list">
      <li>
        <a href="./php/news.php">
          <i class="fa fa-bullhorn" aria-hidden="true"></i>
          <span class="links_name">Жанылыктар </span>
        </a>
         <span class="tooltip">Жанылыктар</span>
      </li>
      <li>
       <a href="./php/mugalim.php">
         <i class="fa fa-users" aria-hidden="true"></i>
         <span class="links_name"> Мугалимдер </span>
       </a>
       <span class="tooltip">Мугалимдер</span>
     </li>
     <li>
       <a href="./php/tapshyrma.php">
         <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
         <span class="links_name"> Тапшырма</span>
       </a>
       <span class="tooltip">Тапшырма</span>
     </li>
     <li>
       <a href="./php/pipul.php">
         <i class="fa fa-graduation-cap" aria-hidden="true"></i>
         <span class="links_name"> Окуучулар</span>
       </a>
       <span class="tooltip">Окуучулар</span>
     </li>
     <li>
       <a href="./php/rospisanie.php">
         <i class="fa fa-file-text" aria-hidden="true"></i>
         <span class="links_name"> Жадыбал</span>
       </a>
       <span class="tooltip">Жадыбал</span>
     </li>
     <li>
       <a href="./php/predmet.php">
         <i class="fa fa-book" aria-hidden="true"></i>
         <span class="links_name"> Предмет</span>
       </a>
       <span class="tooltip">Предмет</span>
     </li>
     <li>
       <a href="./php/cheirek.php">
         <i class="fa fa-star" aria-hidden="true"></i>
         <span class="links_name"> Чейрек</span>
       </a>
       <span class="tooltip">Чейрек</span>
     </li>
     <li>
       <a href="./php/baa.php">
         <i class="fa fa-star-half-o" aria-hidden="true"></i>
         <span class="links_name"> Балоо</span>
       </a>
       <span class="tooltip">Балоо</span>
     </li>
          <li>
       <a href="./php/classroom.php">
         <i class="fa fa-university" aria-hidden="true"></i>
         <span class="links_name"> Класс</span>
       <span class="tooltip">Класс</span>
     </li>
          </li>
          <li>
       <a href="./php/test.php">
         <i class="fa fa-check-square-o" aria-hidden="true"></i>
         <span class="links_name"> Тест</span>
       <span class="tooltip">Тест</span>
</a>
     </li>
          </li>
          </li>
          <? if ($_SESSION["status"] == "mug-di") echo '
          <li>
       <a href="./php/arhiv.php">
         <i class="fa fa-history" aria-hidden="true"></i>
         <span class="links_name">Архив</span>
       <span class="tooltip">Архив</span>
       </a>
     </li>
     ';?>
     <li class="profile">
         <div class="profile-details">
           <form action="" method="post">
              <label for="file">
                <img src="<?
                  $fio = $_SESSION["fio"];
                  $res = $conn -> query("SELECT * FROM teacher WHERE fio = '".$fio."'");
                  if (mysqli_num_rows($res)) {
                      $row = mysqli_fetch_array($res);
                      do {
                          if ($row["image"] != "") echo $row["image"];
                          else echo './img/avatar-1577909_640.png';
                      } while ($row = mysqli_fetch_array($res));
                  } 
                ?>" alt="profile">
              </label>
              <input type="file" name="file" accept=".jpg, .png, .jpeg" id="file" onchange="getImagePreview()">
           </form>
           <div class="name_job">
             <div class="name"><? echo $_SESSION["fio"];?></div>
             <div class="job"><?echo $a[$s]?></div>
           </div>
         </div>
         <form action="" method="post">
            <button type="submit" name="submit" id="submit" width="60" style="text-align:center"><i class='bx bx-log-out' id="log_out" ></i></button>
        
          </form>
            <?php
    if (isset($_POST["submit"])) {
      header('Location:./register.php');
      $_SESSION["log"] = "*/*-/*-*/-*/-*/*-/-*/-*/*-/*-/-*/*-/-*/*-/*-/*/*/*//*-*-*--**/*-";
      $_SESSION["pass"] = "*/*-/*-*/-*/-*/*-/-*/-*/*-/#$%#$@#$#$@#$#$#$##@$#$#$@#$#$#@$#@$";
      $_SESSION["status"] = "*/*-/*-*/-*/-*/*-/-*/-*/*-/*-/-*/*-djkf jfkdsljfl; kfsdlfjk dslfkslfkdsfl;";
      echo'
          <script>
              function Load() {
                  window.location.replace("./");
              }
              setTimeout(Load,10);
          </script>
          ';
    }
  ?>
     </li>
    </ul>
          </div>
  </div>
  <script src="./script/jquery-1.11.1.min.js"></script>
    <script>
      function getImagePreview()
      {
        // var image=URL.createObjectURL(event.target.files[0]);
        var imagediv= document.querySelector('label');
        // var newimg=document.createElement('img');
        let x = new FormData();
        x.append("file",document.getElementById('file').files[0]);
        // console.log(x);
        // imagediv.innerHTML='';
        // newimg.src=image;
        // newimg.width="300";
        // imagediv.appendChild(newimg);
        $.ajax({
          url:'./image.php',
          type:'POST',
          cache:false,
          data:x,
          contentType:false,
          processData:false,
          dataType:'html',
          success: function (data) {
            document.querySelector("label").innerHTML = data;
          }
        });
      }


  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });
 document.querySelector(".menu_bur").addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });
  // following are the code to change sidebar button(optional)
  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
     document.querySelector(".kundoluk").innerHTML = '<img src="./img/k.png" width="40" style="border-radius:50%" alt="">';
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
     document.querySelector(".kundoluk").innerHTML = "";
   }
  }
  </script>