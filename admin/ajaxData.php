<?php 
include("include/db_connect.php"); 
// echo $_POST["klass_name"];
// exit; 
if(!empty($_POST["klass_name"])){ 
$result = mysql_query("SELECT * FROM pupil where klass_aty='".$_POST['klass_name']."'",$link);
                    if (mysql_num_rows($result) > 0) 
                     {
                        $row = mysql_fetch_array($result);
                        do
                        {
                            echo '

                                    <option>'.$row["fio"].'</option>
                            ';
                        }
                        while($row = mysql_fetch_array($result));
                     } 

}
 ?>