<!DOCTYPE html>
<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

$turtle_id = $_GET['id'];
$sqlTurtle = "select * from turtle where turtle_id='".$turtle_id."'";
$turtleResult = mysqli_query($conn, $sqlTurtle);
$turtleData = $turtleResult->fetch_assoc();

	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}

function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    $dateaDiff= $interval->format($differenceFormat);
   
    return str_replace("Days","วันที่แล้ว",$dateDiff);
}



?>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">
          <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="./css/adminlte.min.css">
        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
    </head>

    <body data-ma-theme="green">
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
                    <a href='matching.php'><i class="zmdi zmdi-camera-add"></i> </a>
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
                        
                        <li><a href="matching.php"><i class="zmdi zmdi-camera-add"></i> ค้นหาเต่าด้วยรูปภาพ</a></li>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="user__img" src='./Turtle/<?php echo $turtleData['turtle_profile'];?>'>
                </div>

                <h3 class="profile-username text-center"><?php echo $turtleData['turtle_name'];?></h3>

                <p class="text-muted text-center"><?php echo $turtleData['turtle_type']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                      <b>ไมโครชิพ: <i><?php echo $turtleData['turtle_microchip_code'];?> </i></b>
                  </li>
                  <li class="list-group-item">
                      <b>TAG: <i><?php echo $turtleData['turtle_tag_code'];?></i></b>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">ประวัติการถูกพบ</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ตำแหน่งที่พบเต่า</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                    <?php
                      $sql1 = "select * from found where turtle_id='".$turtle_id."'";
                      $result = mysqli_query($conn, $sql1);
                      if( mysqli_num_rows($result) == 0)
                      {
                        echo "<li class='time-label'>";
                        echo "<span class='bg-danger'>";
                        echo "ยังไม่เคยถูกพบ";
                        echo "</span>";
                        echo "</li>";
                          
                      }
                      else{
                          
                          while($row=$result->fetch_assoc())
                          {
                             $foundDate = $row['found_date'];
                              $foundPic = $row['found_picure'];
                              $turtle_id = $row['turtle_id'];
                              $sql2 = "select * from turtle where turtle_id='".$turtle_id."'";
                              $resultTurtle = mysqli_query($conn, $sql2);
                              $turtleData = $resultTurtle->fetch_assoc();
                              $turtle_name = $turtleData['turtle_name'];
                              
                              $dt = new DateTime($foundDate);
                             // $timestamp = strtotime($turtleData);
                              
                              echo "<li class='time-label'>";
                              echo "<span class='bg-success'>";
                              echo DateThai($foundDate);
                              echo "</span>";
                              echo "</li>";
                                  
                            echo "<li>";
                            echo "<i class='fa fa-camera bg-blue'></i>";

                            echo "<div class='timeline-item'>";
                            echo "<div class='timeline-footer'>";
                            echo "</div>";
                            echo "</div>";
                            echo "</li>";

                          }
                          

                          
                          
                      }

                    ?>
                      <!-- END timeline item -->
                    </ul>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                      <div class="card" style="height: 600px;">
                            <div class="card-body" id = "map">
                        </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
        

 <script>
<?php
    $sqlMap = "select * from found where turtle_id='".$turtle_id."'";
    $mapResult = mysqli_query($conn, $sqlMap);
?>
function myMap() {
    var x = document.getElementById("map");
   
    var mapProp= {
   
    center:new google.maps.LatLng(13.736717, 100.523186),
    zoom:5
    };

   var map=new google.maps.Map(document.getElementById("map"),mapProp);

<?php 
    
    $numLoc = mysqli_num_rows($mapResult);
   
    if($numLoc > 0)
    {
        
        echo "var locations = [";
        $numRow = 1;
        while($row=$mapResult->fetch_assoc())
        {
            if($numRow < $numLoc)
                echo "[".$row['found_lat'].",".$row['found_lng']."],";
            else
               echo "[".$row['found_lat'].",".$row['found_lng']."]";
            
        }
        
        echo "];\n";
        
        
        echo "for (var i = 0; i < ".$numLoc."; i++) {";  
        echo "var marker = new google.maps.Marker({";
        echo "    position: new google.maps.LatLng(locations[i][0], locations[i][1]),";
        echo "    map: map";
        echo "});";
                   
        
	echo "}";                  
                             
    }

?>
    
};
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo6U_Cb7Ywu2_TLPqhv5YJDQH4sbeGcFg&callback=myMap"></script>
        
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
