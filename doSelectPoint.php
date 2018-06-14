<?php
  session_start();
  require 'connect.php';
  
  $leftX = $_POST['leftX'];
  $leftY = $_POST['leftY'];
  $rightX = $_POST['rightX'];
  $rightY = $_POST['rightY'];
  $turtle_id = $_POST['turtleId'];

  $leftName = "".$turtle_id."_Left";
  $rightName = "".$turtle_id."_Right";
  
  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$leftX."\" \"".$leftY."\" ".$leftName);
  echo $result;
  echo "<br>";


  $result = shell_exec("sudo python3 /var/www/html/turtleMatchingApp/delaunay2D_plotDemo.py \"".$rightX."\" \"".$rightY."\" ".$rightName);
   echo $result;

    
?>

<html>

<body>
    
<div class="row" align="center">
                    <div class="col-md-12">
                        <img src="img/green.jpg" style="width:30%; height:auto;"><br><br>
                        <div class="card-title">
                        <h3>ดำเนินการเสร็จสิ้น</h3>
                        </div><br>
                    <form action="index.php">
                     <button type="submit" class="btn btn-success">กลับสู่หน้าหลัก</button>
                    </form>
                    </div>
              </div>
    
</body>
</html>