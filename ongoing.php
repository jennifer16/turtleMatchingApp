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
        <meta charset="utf-8">
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
                    <li class="top=nav">
                    <a href='matching.php'><i class="zmdi zmdi-camera-add"></i> </a>
                    </li>
                    <li class="dropdown top-nav__notifications">
                        <a href="" data-toggle="dropdown" class="top-nav__notify">
                            <i class="zmdi zmdi-notifications"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block">
                            <div class="listview listview--hover">
                                <div class="listview__header">
                                    การพบเจอเต่าในธรรมชาติ

                                    <div class="actions">
                                        <a href="" class="actions__item zmdi zmdi-check-all" data-ma-action="notifications-clear"></a>
                                    </div>
                                </div>

                                <div class="listview__scroll scrollbar-inner">
                                    <a href="" class="listview__item">
                                        <img src="demo/img/profile-pics/1.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">สมหญิง รักดี</div>
                                            <p>พบเจอเต่าในธรรมชาติ</p>
                                        </div>
                                    </a>

                                    <a href="" class="listview__item">
                                        <img src="demo/img/profile-pics/2.jpg" class="listview__img" alt="">

                                        <div class="listview__content">
                                            <div class="listview__heading">สมชาย รักเรียน</div>
                                            <p>พบเจอเต่าในธรรมชาติ</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="p-1"></div>
                            </div>
                        </div>
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

                <div class="row" align="center">
                    <div class="col-md-12">
                        <img src="img/green.jpg" style="width:30%; height:auto;"><br><br>
                        <div class="card-title">
                        <h3>กำลังดำเนินการ ท่านสามารถใช้งานฟังก์ชันอื่น ๆ </h3><br>
                        <h3>เมื่อดำเนินการเสร็จสิ้น จะมีการแจ้งเตือนด้านบน</h3>
                        </div><br>
                    <form action="index.php">
                     <button type="submit" class="btn btn-success">กลับสู่หน้าหลัก</button>
                    </form>
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
        function fetchdata(){
 $.ajax({
  url: 'fetchFinishMatching.php',
  type: 'post',
  success: function(response){
   // Perform operation on the return value
   alert(response);
  }
 });
}

$(document).ready(function(){
 setInterval(fetchdata,10000);
});
        </script>

    </body>
</html>
