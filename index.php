<!DOCTYPE html>
<?php
require 'connect.php';
session_start();
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
                    <h1><a href="index.html"><img src="img/noun_1546379_cc.png"><b>คู่มือเต่าทะเล</b></a></h1>
                    
                </div>

                <ul class="top-nav">
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

            <aside class="sidebar">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="demo/img/profile-pics/8.jpg" alt="">
                            <div>
                                <div class="user__name">มานี มีทุ่งนา</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">ดูรายละเอียด</a>
                            <a class="dropdown-item" href="">ออกจากระบบ</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li class="navigation__active"><a href="index.html"><i class="zmdi zmdi-home"></i> หน้าหลัก</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-view-week"></i> ข้อมูลเต่าทั้งหมด</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-replay"></i> ประวัติการพบเต่า</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-camera-add"></i> ค้นหาเต่าด้วยรูปภาพ</a></li>

                        <li class="navigation__sub">
                            <a href=""><i class="zmdi zmdi-collection-text"></i> จัดการข้อมูลเต่า</a>

                            <ul>
                                <li><a href="#">เพิ่มข้อมูลเต่า</a></li>
                                <li><a href="#">แก้ไขข้อมูลเต่า</a></li>
                                <li><a href="#">ลบข้อมูลเต่า</a></li>
                            </ul>
                        </li>

                        <li><a href="#"><i class="zmdi zmdi-layers"></i> เต่าที่พบในธรรมชาติ</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-repeat"></i> ข้อมูลแม่เต่าที่ขึ้นมาวางไข่</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-email"></i> ติดต่อเรา</a></li>

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
function myMap() {
    var x = document.getElementById("map");
    x.innerHTML = "<p>test</p>";
    console.log(x);
var mapProp= {
    center:new google.maps.LatLng(51.508742,-0.120850),
    zoom:5,
};
var map=new google.maps.Map(document.getElementById("map"),mapProp);
}
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo6U_Cb7Ywu2_TLPqhv5YJDQH4sbeGcFg&callback=myMap"></script>
    </body>
</html>