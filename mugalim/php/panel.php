 <div class="menu">
    <div class="logo-details">
      <i><img src="../img/k.png" width="50" style="border-radius:50%" alt=""></i>
        <div class="logo_name">Күндөлүк</div>
        <i class="menu_bur"></i>
    </div>
 </div>
 <div class="sidebar">
    <div class="logo-details">
      <i class="kundoluk"></i>
        <div class="logo_name">Күндөлүк</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <div class = "scroll" <?if ($_SESSION["status"] == "mug-di") echo 'style="height:80vh"';?>>
    <ul class="nav-list">
      <li>
        <a href="./news.php">
           <i class="fa fa-bullhorn" aria-hidden="true"></i>
          <span class="links_name">Жанылыктар </span>
        </a>
         <span class="tooltip">Жанылыктар</span>
      </li>
      <li>
       <a href="./mugalim.php">
  <i class="fa fa-users" aria-hidden="true"></i>
         <span class="links_name"> Мугалимдер </span>
       </a>
       <span class="tooltip">Мугалимдер</span>
     </li>
     <li>
       <a href="./tapshyrma.php">
         <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
         <span class="links_name"> Тапшырма</span>
       </a>
       <span class="tooltip">Тапшырма</span>
     </li>
     <li>
       <a href="./pipul.php">
    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
         <span class="links_name"> Окуучулар</span>
       </a>
       <span class="tooltip">Окуучулар</span>
     </li>
     <li>
       <a href="./rospisanie.php">
<i class="fa fa-file-text" aria-hidden="true"></i>
         <span class="links_name"> Жадыбал</span>
       </a>
       <span class="tooltip">Жадыбал</span>
     </li>
     <li>
       <a href="./predmet.php">
         <i class="fa fa-book" aria-hidden="true"></i>
         <span class="links_name"> Предмет</span>
       </a>
       <span class="tooltip">Предмет</span>
     </li>
     <li>
       <a href="./cheirek.php">
         <i class="fa fa-star" aria-hidden="true"></i>
         <span class="links_name"> Чейрек</span>
       </a>
       <span class="tooltip">Чейрек</span>
     </li>
     <li>
       <a href="./baa.php">
         <i class="fa fa-star-half-o" aria-hidden="true"></i>
         <span class="links_name"> Балоо</span>
       </a>
       <span class="tooltip">Балоо</span>
     </li>
          <li>
       <a href="./classroom.php">
<i class="fa fa-university" aria-hidden="true"></i>
         <span class="links_name"> Класс</span>
       <span class="tooltip">Класс</span>
</a>
     </li>
          </li>
          <li>
       <a href="./test.php">
         <i class="fa fa-check-square-o" aria-hidden="true"></i>
         <span class="links_name"> Тест</span>
       <span class="tooltip">Тест</span>
</a>
     </li>
          </li>
          </li>
          <? if ($_SESSION["status"] == "mug-di") echo '
          <li>
       <a href="./arhiv.php">
<i class="fa fa-history" aria-hidden="true"></i>
         <span class="links_name">Архив</span>
         </a>
       <span class="tooltip">Архив</span>
     </li>
     ';
     ?>
     <li class="profile">
         <div class="profile-details">
           <img src=".<?
                  $fio = $_SESSION["fio"];
                  $res = $conn -> query("SELECT * FROM teacher WHERE fio = '".$fio."'");
                  if (mysqli_num_rows($res)) {
                      $row = mysqli_fetch_array($res);
                      do {
                          if ($row["image"] != "") echo $row["image"]."";
                          else echo './img/avatar-1577909_640.png';
                      } while ($row = mysqli_fetch_array($res));
                  } 
                ?>" alt="profile">
           <div class="name_job">
             <div class="name"><? echo $_SESSION["fio"]."";?></div>
             <div class="job"><?
                        $we = array(
        "mug" => "Мугалим",
        "mug-kl" => "Класс жетекчи",
        "mug-za" => "Завуч",
        "mug-di" => "Директор",
    );
             echo $we[$s]."";
             ?>
             </div>
           </div>
         </div>
         <form action="" method="post">
            <button type="submit" name="exit" width="60" style="text-align:center"><i class='bx bx-log-out' id="log_out"  ></i></button>
         </form>
     </li>
    </ul>
          </div>
  </div>
  <?
    if (isset($_POST["exit"])) {
      $_SESSION["log"] = "*/*-/*-*/-*/-*/*-/-*/-*/*-/*-/-*/*-/-*/*-/*-/*/*/*//*-*-*--**/*-";
      $_SESSION["pass"] = "*/*-/*-*/-*/-*/*-/-*/-*/*-/#$%#$@#$#$@#$#$#$##@$#$#$@#$#$#@$#@$";
      $_SESSION["status"] = "*/*-/*-*/-*/-*/*-/-*/-*/*-/*-/-*/*-djkfjfkdsljfl;kfsdlfjk dslfkslfkdsfl;";
       echo'
          <script>
              function Load() {
                  window.location.replace("../register.php");
              }
              setTimeout(Load,10);
          </script>
          ';
    }
  ?>
    <script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");

  document.querySelector(".menu_bur").addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
     document.querySelector(".kundoluk").innerHTML = '<img src="../img/k.png" width="40" style="border-radius:50%" alt="">';
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
     document.querySelector(".kundoluk").innerHTML = "";
   }
  }
  </script>