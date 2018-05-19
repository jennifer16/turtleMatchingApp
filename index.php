<!DOCTYPE html>
<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
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
                                echo "<li><a href='deleteTurtle.php'><i class='zmdi zmdi-delete'></i> ลบข้อมูลเต่า</a></li>";


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
                        
                        <li><a href="contact.php"><i class="zmdi zmdi-email"></i> ติดต่อเรา</a></li>

                    </ul>
                </div>
            </aside>

          <section class="content">


                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>

                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="demo/img/carousel/c-1.jpg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="demo/img/carousel/c-2.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="demo/img/carousel/c-3.jpg" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                            </div><hr>

              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">สรุปข้อมูลเต่า</h4>
                    <div class="row quick-stats">
                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-blue" >
                            <div class="quick-stats__info" >
                                <h2>150</h2>
                                <small>เต่าที่่ปล่อยทั้งหมด</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3"> 
                        <div class="quick-stats__item bg-amber">
                            <div class="quick-stats__info">
                                <h2>3</h2>
                                <small>เต่าที่พบในธรรมชาติ</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-purple">
                            <div class="quick-stats__info">
                                <h2>13</h2>
                                <small>เต่าที่มีการพบมากกว่า 1 ครั้ง</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item bg-red">
                            <div class="quick-stats__info">
                                <h2>18</h2>
                                <small>ผู้ใช้ที่รายงานการพบเต่า</small>
                            </div>
                        </div>
                    </div>
                </div>
                  </div>
              </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="card" style="height: 600px;">
                            
                            <div class="card-body" id = "map">
                               
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">เต่าที่พบล่าสุด</h4>
                                <figure style="margin-bottom: 5px">
  <p><img src="img/turtle.jpg"
    alt="" style="width: 100%; height: auto;">
  <figcaption>พบโดย: ชบา หลานคุณยาย <br> พิกัด: 100.23, 35.35</figcaption>
</figure>
                                <figure style="margin-bottom: 5px">
  <p><img src="img/turtle.jpg"
    alt="" style="width: 100%; height: auto;">
  <figcaption>พบโดย: ชบา หลานคุณยาย <br> พิกัด: 100.23, 35.35</figcaption>
</figure>
                                <figure style="margin-bottom: 5px">
  <p><img src="img/turtle.jpg"
    alt="" style="width: 100%; height: auto;">
  <figcaption>พบโดย: ชบา หลานคุณยาย <br> พิกัด: 100.23, 35.35</figcaption>
</figure>
                                
                                
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
    $sqlMap = "select * from found";
    $mapResult = mysqli_query($conn, $sqlMap);
?>
function myMap() {
    var x = document.getElementById("map");
    x.innerHTML = "<p>test</p>";
    console.log(x);
var mapProp= {
    <?php
    if( mysqli_num_rows($mapResult) == 0)
    {    
        echo "center:new google.maps.LatLng(13.736717, 100.523186),";
    }else{
        
        $sqlLat ="SELECT AVG(found_lat) FROM found where user_id ='".$_SESSION['user_id']."'";
        $latResult = mysqli_query($conn, $sqlLat);
        $row = $latResult->fetch_assoc();
        $centerLat = $row[0];   
        
        $sqlLng ="SELECT AVG(found_lng) FROM found where user_id ='".$_SESSION['user_id']."'";
        $lngResult = mysqli_query($conn, $sqlLng);
        $row = $lngResult->fetch_assoc();
        $centerLng = $row[0];    
        
        echo "center:new google.maps.LatLng(".$centerLat.",".$centerLng."),";
    }
    ?>
    zoom:5,
}
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
        
        echo "]";
        
        
        echo "for (var i = 0; i < ".$numLoc."; i++) {";  
        echo "var marker = new google.maps.Marker({";
        echo "    position: new google.maps.LatLng(locations[i][1], locations[i][2]),";
        echo "    map: map";
        echo "});";

        echo "markers.push(marker);";                    
                             
                             
    }

?>
    
}
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
