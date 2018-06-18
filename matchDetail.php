<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

?>

<?php
    
    $id = $_GET['id'];
    $sql = "select * from matching where id='".$id."'";
    $result = mysqli_query($conn,$sql);
    $row = $result->fetch_assoc();
    $outputFile = $row['match_file'];
    $myfile = fopen($outputFile, "r") or die("Unable to open file!");

    $myfile1 = fopen($outputFile, "r") or die("Unable to open file!");

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
  
    </head>

    <body data-ma-theme="green">
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=161713021336907&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger hidden-xl-up" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="index.php"><img src="img/noun_1546379_cc.png"><b>คู่มือเต่าทะเล</b></a></h1>
                    
                </div>

                <ul class="top-nav">
                    <li class="top-nav">
                    <a href='matching.php'><i class="zmdi zmdi-camera"></i> </a>
                    </li>
                    <li class="top-nav">
                     <a href='matchingResult.php' id='bell'><i class="zmdi zmdi-notifications"></i></a>
                    </li>
                </ul>
            </header>
            <!-- Left Menu -->
            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="https://graph.facebook.com/<?php echo $_SESSION['user_id']; ?>/picture?type=normal">
                            <div>
                                <div class="user__name"><?php echo $_SESSION['user_firstname']." ".$_SESSION['user_lastname'];?></div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="userProfile.php">ดูรายละเอียด</a>
                            <a class="dropdown-item" href="signout.php">ออกจากระบบ</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li class="navigation__active"><a href="index.php"><i class="zmdi zmdi-home"></i> หน้าหลัก</a></li>
                        
                        <li><a href="allTurtle.php"><i class="zmdi zmdi-view-week"></i> ข้อมูลเต่าทั้งหมด</a></li>
                        
                        <li><a href="foundTurtleHistory.php"><i class="zmdi zmdi-replay"></i> ประวัติการพบเต่า</a></li>
                        
                        <li><a href="matching.php"><i class="zmdi zmdi-camera"></i> ค้นหาเต่าด้วยรูปภาพ</a></li>
                        <?php
                            if ($_SESSION['user_role']==1)
                            {
                                echo "<li><a href='addTurtle.php'><i class='zmdi zmdi-collection-plus'></i> เพิ่มข้อมูลเต่า</a></li>";
                                echo "<li><a href='editTurtle.php'><i class='zmdi zmdi-collection-text'></i> แก้ไขข้อมูลเต่า</a></li>";


                            }
                        ?>
                        
                        <?php
                            if ($_SESSION['user_role']==1)
                            { echo "<li><a href='foundTurtleList.php'><i class='zmdi zmdi-layers'></i> เต่าที่พบในธรรมชาติ</a></li>"; }
                        ?>
                        
                        <?php
                            if ($_SESSION['user_role']==1)
                            { echo "<li><a href='#'><i class='zmdi zmdi-repeat'></i> ข้อมูลแม่เต่าที่ขึ้นมาวางไข่</a></li>"; }
                        ?>
                        

                    </ul>
                </div>
            </aside>


 <section class="content">
     <div class="row">
        <div class="col-12">
          <div class="card">
             
            <!-- /.card-header -->
            <div class="card-body">
            <h5>ผลการเปรียบเทียบ</h5>

            <br> 
            <figure style="margin-bottom: 5px">
  <p><img src="Input/<?php echo $row['match_input'];?>"
    alt="" style="width: 100%; height: auto;">
             <figcaption>รุปภาพที่ใช้ค้นหา</figcaption>
</figure>            
  
                <br>
                <br>
                <label>ผลการค้นหา</label>
              <table id="listTurtle" style="width:100%; table-layout: fixed;">
                <tbody>
<?php
                $count = 0;
                 while (!feof($myfile)) {
                     $line = fgets($myfile);

			         if ($line[0] != "$")
				            continue;
                    $words = explode(",", $line);
                    
                    if( (float)$words[1] > -1 )
                    {
                        $count+=1;
                     
                    $sqlTurtle = "select * from turtle where turtle_id='".substr($words[0],1)."'";
                    $resultTurtle = mysqli_query($conn, $sqlTurtle);
                    $rowTurtle = $resultTurtle->fetch_assoc();
                    $turtleId = $rowTurtle['turtle_id'];
                    $turtleProfile = $rowTurtle['turtle_profile'];
                     
                    echo "<tr style='border: solid thin;' >\n";
                    echo "<td align='center'><a><div data-toggle='modal' data-target='#modal-large-".$turtleId."'><img src='./Turtle/".$turtleProfile."' stype='display:block;'  width='100%' height='100%' ></div></a></td>\n";
                    echo "<td align='center'>ความคล้าย: ".$words[1]." %</td>\n";
                    if ( (float)$words[4] > 120.0)
                        echo "<td align='center'>Matching Score: <font color='green'>".$words[4]."</font></td>\n";
                    else if( (float)$words[4] > 20.0)
                        echo "<td align='center'>Matching Score: <font color='yellow'>".$words[4]."</font></td>\n";
                    else
                        echo "<td align='center'>Matching Score: <font color='red'>".$words[4]."</font></td>\n";
                        
               if ($_SESSION['user_role']==1) {echo "<td align='center'><a href='".$words[3]."'> ดาวน์โหลดรูปการจับคู่ </a></td>\n"; 
                
                    echo "<td align='center'><button type='button' class='btn btn-info' onclick='foundTurtle(".$turtleId.",".$id.");'>รายงานการพบเต่าตัวนี้</button></td>\n";}
                        
                    echo "</tr>\n";
                    }
}
                    
                    
         

		fclose($myfile);
                    
?>
                


                </tbody>
              </table>
                
<?php
          
                 while (!feof($myfile1)) {
                     $line = fgets($myfile1);

			         if ($line[0] != "$")
				            continue;
                    $words = explode(",", $line);
                    
                    if( (float)$words[1] > -1 )
                    {
                         $sqlTurtle = "select * from turtle where turtle_id='".substr($words[0],1)."'";
                    $resultTurtle = mysqli_query($conn, $sqlTurtle);
                    $rowTurtle = $resultTurtle->fetch_assoc();
                    $turtleId = $rowTurtle['turtle_id'];
                    $turtlename = $rowTurtle['turtle_name'];
                    $turtleProfile = $rowTurtle['turtle_profile'];
                        $turtleMicro = $rowTurtle['turtle_microchip_code'];
                        $turtleTag = $rowTurtle['turtle_tag_code'];
              
                            echo "<div class=\"modal fade\" id=\"modal-large-".$turtleId."\" tabindex=\"-1\">";
                            echo "<div class=\"modal-dialog modal-lg\">";
                            echo "<div class=\"modal-content\">";
                            echo "<div class=\"modal-header\">";
                            echo "<h5 class=\"modal-title pull-left\">รายละเอียดของเต่า</h5>";
                            echo "</div>";
                            echo "<div class=\"modal-body\">";
                        
                        
                            echo "<div class='container'>";
                            echo "<img src='./Turtle/".$turtleProfile."' stype='display:block;'  width='100%' height='100%' ><br>";
                            echo "<hr><ul>";
                            echo "<li><label><b>ชื่อ: </b>".$turtlename."</label></li>";
                            echo "<li><label><b>รหัสไมโครชิพ: </b>".$turtleMicro."</label></li>";
                            echo "<li><label><b>TAG: </b>".$turtleTag."</label></li>";
                            echo "</ul>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class=\"modal-footer\">";
                                            
                            echo "<button type=\"button\" class=\"btn btn-link\" data-dismiss=\"modal\">ปิด</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                    }
                 }
                fclose($myfile1);
?>
                <br>
            <?php 
                
                    echo "<div class='row' align='center'>";
                    echo "<div class='col-12'>";

            if ($_SESSION['user_role']==1){        echo "<button type='button' class='btn btn-warning' onclick='addTurtle(".$id.");'>รายงานเป็นการพบเต่าตัวใหม่</button>";
                                          }
                else{
                    
                    echo "<div class='fb-share-button' data-href='https://studioxpert.com/turtleMatchingApp' data-layout='button_count' data-size='large' data-mobile-iframe='true'><a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fstudioxpert.com%2FturtleMatchingApp&amp;src=sdkpreparse' class='fb-xfbml-parse-ignore'>Share เรื่องราวให้เพื่อนของคุณ</a></div>";
                    
                    
                }
                    echo "</div>";
                    echo "</div>";
                    
                
            ?>
                     
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

                <footer class="footer hidden-xs-down">
                </footer>
            </section>
        </main>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <script src="vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="vendors/bower_components/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="vendors/bower_components/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <script src="vendors/bower_components/salvattore/dist/salvattore.min.js"></script>
        <script src="vendors/jquery.sparkline/jquery.sparkline.min.js"></script>
        <script src="vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
        
  
        <script>
    function foundTurtle(id1,id2){

        window.location='foundTurtle.php?turtleId='+id1+'&matchId='+id2;
    }
    
    function addTurtle(id){
        window.location='addTurtle.php?matchId='+id;
    }
    

</script>
        
                <script>
            String.prototype.trim = function() {
return this.replace(/^\s+|\s+$/g,"");
};
function fetchdata(){
 $.ajax({
  url: 'fetchFinishMatching.php',
  type: 'post',
  success: function(response){
   // Perform operation on the return value
   if( response.trim() == '1'){
     $('#bell').addClass('top-nav__notify');
   }else{
        $('#bell').removeClass('top-nav__notify');
   }
  }
 });
}

$(document).ready(function(){
 setInterval(fetchdata,10000);
});
        </script>

    </body>
</html>
