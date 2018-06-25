<!DOCTYPE html>
<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

$sql = "select * from matching where match_pid is null or match_pid=''";
$result = mysqli_query($conn, $sql);
$numWaitForMatch = mysqli_num_rows($result);

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
                            { echo "<li><a href='foundTurtleList.php'><i class='zmdi zmdi-layers'></i> เต่าที่พบ</a>";
                             if($numWaitForMatch>0)  echo "<span class='badge badge-light'>".$numWaitForMatch."</span>";
                             echo "</li>"; }
                        ?>
                        
                        <?php
                            if ($_SESSION['user_role']==1)
                            { echo "<li><a href='#'><i class='zmdi zmdi-repeat'></i> ข้อมูลแม่เต่าที่ขึ้นมาวางไข่</a></li>"; }
                        ?>

                    </ul>
                </div>
            </aside>

          <section class="content">


                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="demo/img/carousel/c-1.jpg" alt="First slide"$numWaitForMatch>0
                                     </div>
                                    <div class="carousel-item">
                                        <img src="demo/img/carousel/c-2.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="demo/img/carousel/c-3.jpg" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <i class="zmdi zmdi-arrow-left"></i>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                   <i class="zmdi zmdi-arrow-right"></i>
                                </a>
                            </div><hr>

              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">สรุปข้อมูลเต่า</h4>
                    <div class="row quick-stats">
                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-blue" >
                            <div class="quick-stats__info" >
                                <?php
                                    $sqlAllturtle = "select * from turtle";
                                    $resultAllturtle = mysqli_query($conn,$sqlAllturtle);
                                    echo "<h2>".mysqli_num_rows($resultAllturtle)."</h2>";
                                ?>
                                <small>เต่าที่่ปล่อยทั้งหมด</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3"> 
                        <div class="quick-stats__item bg-amber">
                            <div class="quick-stats__info">
                                <?php
                                    $sqlTurtleNature = "select DISTINCT turtle_id from found where found_status='0'";
                                    $resultTurtleNature = mysqli_query($conn,$sqlTurtleNature);
                                    echo "<h2>".mysqli_num_rows($resultTurtleNature)."</h2>";
                                ?>
                                <small>รายงานการพบเต่า</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-purple">
                            <div class="quick-stats__info">
                                <?php
                                
                                     $sqlReport = "select count(*), turtle_id from found group by turtle_id having count(*) > 1";
                                    $resultReport = mysqli_query($conn,$sqlReport);
                                    echo "<h2>".mysqli_num_rows($resultReport)."</h2>";
        
                                ?>
                                <small>เต่าที่มีการพบมากกว่า 1 ครั้ง</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-red">
                            <div class="quick-stats__info">
                                 <?php
                                    $sqlTurtleNature = "select DISTINCT user_id from found where found_status='0'";
                                    $resultTurtleNature = mysqli_query($conn, $sqlTurtleNature);
                                    echo "<h2>".mysqli_num_rows($resultTurtleNature)."</h2>";
                                ?>
                                <small>ผู้ใช้ที่รายงานการพบเต่า</small>
                            </div>
                        </div>
                    </div>
                </div>
                  </div>
              </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">เต่าที่พบล่าสุด</h4>
                                <div class="row">
                                <?php
                                    $sqlLast = "SELECT
                                    found.found_id,
                                    found.turtle_id,
                                    found.user_id,
                                    found.found_lat,
                                    found.found_lng,
                                    found.found_picure,
                                    found.found_date,
                                    turtle.turtle_name
                                    FROM
                                    turtle
                                    LEFT JOIN found ON found.turtle_id = turtle.turtle_id
                                    ORDER BY
                                    found.found_date DESC";
                                    $lastResult = mysqli_query($conn, $sqlLast);
                                    $numFound  = mysqli_num_rows($lastResult);
                                    if($numFound == 0)
                                    {
                                        echo "<label>ยังไม่มีการพบเต่า</label>" ;
                                    }
                                    else{
                                    $numPrint=1;
                                    while($numPrint<=$numFound && $numPrint<=4)
                                    {
                                        $row = $lastResult->fetch_assoc();
                                        
                                        $sqlUser = "select * from users where user_id='".$row['user_id']."'";
                                        $userResult = mysqli_query($conn, $sqlUser);
                                        $rowUser = $userResult->fetch_assoc();
                                        $userName = $rowUser['user_firstname'];
                                        $userLastname = $rowUser['user_lastname'];
                                        
                                        // echo "<figure style='margin-bottom: 5px'>";
                                        // echo "<p><a href='turtleDetail.php?id=".$row['turtle_id']."'><img src='./Turtle/".$row['found_picure']."'";
                                        // echo " alt='' style='width: 100%; height: auto;'></a>";
                                        // echo "<figcaption>พบโดย: ".$userName." ".$userLastname."</figcaption>";
                                        // echo "</figure>";
                             ?>
                                    <div class="col-sm-6 col-md-3"> 
                                        <div class="card widget-contacts">
                                            <a class="widget-contacts__map" href="<?php echo "turtleDetail.php?id=".$row['turtle_id']?>">
                                                <img src="<?php echo "./Turtle/".$row['found_picure']; ?>" alt="">
                                            </a>                                            
                                            <div class="card-block">
                                                <ul class="icon-list">
                                                    <li><?php echo $row['turtle_name']; ?></li>                                                    
                                                    <li><i class="zmdi zmdi-facebook-box"></i> <?php echo $userName." ".$userLastname; ?></li>
                                                    <li><i class="zmdi zmdi-calendar"></i> <?php echo $row['found_date']; ?></li>
                                                    <li><i class="zmdi zmdi-pin"></i>
                                                       <address id='address<?php echo $row['found_id'];?>'>
                                                        
                                                        </address>
                                                    </li>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>
                             <?php
                                        $numPrint=$numPrint+1;
                                    }
                                        
                                    }
                                ?>                                         
                    </div>        
                        </div>                      
                                         
                                
                            </div>
                            
                        </div>
                    </div>                
                    <div class="col-md-12">
                        <div class="card" style="height: 600px;">
                            
                            <div class="card-body" id = "map">
                               
                            </div>
                        </div>
                    </div>

              </div>
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
    $sqlMap = "SELECT
    found.found_id,
    found.turtle_id,
    found.found_lat,
    found.found_lng,
    found.found_picure,
    turtle.turtle_name,
    turtle.turtle_id
    FROM
    turtle
    LEFT JOIN found ON found.turtle_id = turtle.turtle_id
    ORDER BY
    found.found_date DESC";
    $mapResult = mysqli_query($conn, $sqlMap);
    $mapResult1 = mysqli_query($conn,$sqlMap);
?>
function myMap() {
    var x = document.getElementById("map");
   
    var mapProp= {
   
    center:new google.maps.LatLng(13.736717, 100.523186),
    zoom:5
    
    };

   var map=new google.maps.Map(document.getElementById("map"),mapProp);

<?php 
    
    $i=0;
    while($row=$mapResult1->fetch_assoc())
    {
        if ($i < $numPrint){
        echo "printAddress(".$row['found_id'].",".$row['found_lat'],",".$row['found_lng'].");\n\n";
        $i=$i+1;
        }else{
            break;
        }
        
    }
    
    $numLoc = mysqli_num_rows($mapResult);
   
    if($numLoc > 0)
    {
        
        
        echo "var locations = [";
        $numRow = 1;
        while($row=$mapResult->fetch_assoc())
        {
            if($numRow < $numLoc) {
                echo "[".$row['found_lat'].",".$row['found_lng']."],";                
                $tname = $row['turtle_name'];
                $turl = "turtleDetail.php?id=".$row['turtle_id'];
                //$ticon = "Turtle/"."jHNEebsc6s.JPG";
            }            
            else {
                echo "[".$row['found_lat'].",".$row['found_lng']."]";
                $tname = $row['turtle_name'];
                $turl = "turtleDetail.php?id=".$row['turtle_id'];
                //$ticon = "Turtle/".$row['turtle_profile'];
            }
        }
        
        echo "];\n";
        
        
        echo "for (var i = 0; i < ".$numLoc."; i++) {";  
        echo "var marker = new google.maps.Marker({";
        echo "    position: new google.maps.LatLng(locations[i][0], locations[i][1]),";
        //echo "    icon: '". $ticon."',";
        echo "    url: '".$turl."',";
        echo "    title: '".$tname."',";
        echo "    map: map";
        echo "});";
        echo "google.maps.event.addListener(marker, 'click', function() {
            window.location.href = this.url;
        });";
        
	echo "}";                  
                             
    }

?>
    
};
</script>


    
<script>
    
    function printAddress(id,lat,lng)
    {
        var place1 = document.getElementById('address'+id);
       
        var geocoder = new google.maps.Geocoder;
    
        var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              
              place1.innerHTML = results[0].formatted_address
            } else {
            place1.innerHTML = "ไม่ทราบข้อมูลสถานที่";
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }

        
    
    
        
</script>    
    


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVlIZSpzYkePXCjcm9xRHuFyL2DbKZY0Q&callback=myMap"></script>     
        
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
