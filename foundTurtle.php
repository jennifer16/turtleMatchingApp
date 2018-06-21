<!DOCTYPE html>
<?php
require 'connect.php';
session_start();
if( !isset($_SESSION["user_id"]) ){
    header("location:login.php");
}

$turtleId = '';
if( isset($_GET['turtleId']))
    $turtleId = $_GET['turtleId'];

$matchId = '';
if( isset($_GET['matchId']))
    $matchId = $_GET['matchId'];

$matchSQL="select * from matching where id='".$matchId."'";
$matchResult = mysqli_query($conn, $matchSQL);
$matchData = $matchResult->fetch_assoc();
$matchPic = './Turtle/'.$matchData['match_profile'];
$matchLat = $matchData['match_lat'];
$matchLng = $matchData['match_lng'];
$matchWeight = $matchData['match_weight'];
$matchLength = $matchData['match_length'];
$matchWidth = $matchData['match_width'];

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
        
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/cropper.css">
  <style>
    .label {
      cursor: pointer;
    }

    .progress {
      display: none;
      margin-bottom: 1rem;
    }

    .alert {
      display: none;
    }

    .img-container img {
      max-width: 100%;
    }
  </style>
    </head>

    <body data-ma-theme="green">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.0&appId=161713021336907&autoLogAppEvents=1';
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

      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
             <div class="card">
                <div class="card-body">
                    <h4 class="card-title">รายงานการพบเต่าทะเล</h4>
                </div>
              </div>
            </div>
          </div>
        
              <!-- /.card-header -->
              <!-- form start --> 
          <div class="row" align="center">
              <div class="col-md-6">
                                  <!-- turtle profile image -->
                  <div class="container">
    <label class="label" data-toggle="tooltip" title="คลิกเพื่อเลือกรูปภาพ">ภาพถ่ายประจำตัวเต่า<br>
      <img class="rounded" id="avatarProfile" src='<?php echo $matchPic; ?>' style="width:100%; height:auto;" alt="avatar-Profile">
      <input type="file" class="sr-only" id="inputProfile" name="imageProfile" accept="image/*">
    </label>
     
    <div class="alertProfile" role="alert"></div>
    <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">เลือกส่วนของภาพที่ต้องการ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
              <img id="imageProfile" src="https://avatars0.githubusercontent.com/u/3456749">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" id="cropProfile">ตกลง</button>
          </div>
        </div>
      </div>
    </div>
  </div>
                  <br>
            <label>คลิกที่รูปเพื่อเปลี่ยนรูป</label>
              </div>
              
              <div class="col-md-6"> 
              
         <form role="form" action = "doFoundTurtle.php" method = "POST" enctype = "multipart/form-data">
                 <input type="text" name="turtleId" id="turtleId" value='<?php echo $turtleId; ?>' hidden>
                   <input type="text" name="matchId" id="matchId" value='<?php echo $matchId; ?>' hidden>
                   <input type="text" name="filenameProfile" id="filenameProfile" value='<?php echo $matchPic; ?>' hidden>     

           <div class="row">
               <div class="col-md-12">
                  <label>กรอกข้อมูลของเต่าที่พบ</label>
               </div>
             </div>
         <br>
            <div class="form-group">
                <div class="row">
                   <div class="col-md-4">
                    <label for="latitude">น้ำหนัก (กก.)</label>
                        <input type="text" class="form-control" placeholder="น้ำหนักเต่า" id="weight" name="weight" value="<?php echo $matchWeight; ?>"></div>
                     <div class="col-md-4">
                    <label for="latitude">ความกว้าง (ซม.)</label>
                    <input type="text" class="form-control" id="width" name="width" placeholder="ความกว้างของกระดองเต่า" value="<?php echo $matchWidth; ?>" >
                    </div>
                    <div class="col-md-4">
                    <label for="latitude">ความยาว (ซม.)</label>
                    <input type="text" class="form-control" id="length" name="length" placeholder="ความยาวของกระดองเต่า" value="<?php echo $matchLength; ?>">
                    </div>
               
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                    <label for="latitude">ละติจูด</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="0.00" value='<?php echo $matchLat; ?>'>
                        </div>
                        <div class="col-md-6">
                    <label for="latitude">ลองจิจูด</label>
                    <input type="text" class="form-control" id="longtitude" name="longitude" placeholder="0.00" value='<?php echo $matchLng; ?>'>
                        </div>
                    <br>
                </div><br>
                <div class="row" >
                    <div class="col-md-12" align="center">
                     <label> -- หรือ คลิกและเลือกตำแหน่งในแผนที่ --</label>
                    </div>
                   <div class="col-md-12">
                       
                       <div class="card" style="height: 300px;">
                            
                            <div class="card-body" id = "map">
                               
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-12" align="left">
                    
                        <label id="place1"></label>
                    </div>
                  
                  </div>  
                  <div class="row" align="center">
                    <div class="col-md-12">
               
                  <button type="submit" class="btn btn-primary full-width">บันทึกและแชร์ข้อมูลการพบเต่า</button> 
               
                        </div>
                </div>
            </div>
                  </form>
              </div>
              
          </div>    

            
        <!-- /.row -->
    <!-- /.content -->

                <footer class="footer hidden-xs-down">  </footer>
              </div>
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
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>

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
 
  <script src="js/cropper.js"></script>
      
         <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatarProfile');
      var image = document.getElementById('imageProfile');
      var input = document.getElementById('inputProfile');
      var $alert = $('.alertProfile');
      var $modal = $('#modalProfile');
      var cropper;
      var newFilenameProfile;
      $('[data-toggle="tooltip"]').tooltip();

      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $alert.hide();
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        var filename;

        if (files && files.length > 0) {
          file = files[0];
          filename = file.name;
          var fileext = filename.split('.').pop();
          var text = "";
          var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

          for (var i = 0; i < 10; i++)
             text += possible.charAt(Math.floor(Math.random() * possible.length));

          newFilenameProfile = text+'.'+fileext;
          document.getElementById("filenameProfile").value = newFilenameProfile;
        console.log( document.getElementById("filenameProfile").value);

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      });

      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
          viewMode: 3,
        });
      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

      document.getElementById('cropProfile').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
          });

          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
          //$progress.show();
          $alert.removeClass('alert-success alert-warning');
          canvas.toBlob(function (blob) {
            var formData = new FormData();
	
            formData.append('avatarProfile', blob);
            formData.append('filenameProfile', newFilenameProfile);
         for (var pair of formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
}
            $.ajax('./saveImageForAdd.php', {
              method: 'POST',
              data: formData,
              processData: false,
              contentType: false,

              xhr: function () {
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
              xhr.upload.onprogress = function (e) {
                  var percent = '0';
                  var percentage = '0%';

                  if (e.lengthComputable) {
                    percent = Math.round((e.loaded / e.total) * 100);
                    percentage = percent + '%';
                   // $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                  }
                };

                return xhr;
              },

              success: function () {
               // $alert.show().addClass('alert-success').text('Upload success');
                  console.log('success');
                    $('#search').removeAttr('disabled');
              },

              error: function () {
                avatar.src = initialAvatarURL;
                //$alert.show().addClass('alert-warning').text('Upload error');
                  console.log('error');
              },

              complete: function () {
               // $progress.hide();
              },
            });
          });
        }
      });
    });
  </script>         
<script>
var x = document.getElementById("latitude");
var y = document.getElementById("longtitude");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("cannot get gps");
    }
}
function showPosition(position) {
    x.value = position.coords.latitude;
    y.value = position.coords.longitude;
    latlngChange();
}
    //getLocation();
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
    <script>
function myMap() {
    var x = document.getElementById("map");
    console.log(x);
var mapProp= {
   
    center:new google.maps.LatLng(13.736717, 100.523186),
    zoom:5
}
var map=new google.maps.Map(document.getElementById("map"),mapProp);

var isClick=false;
map.addListener('click', function(e) {
    if(!isClick){
        placeMarker(e.latLng, map);
        isClick=true;
    }
});

function placeMarker(position, map) {
    var marker = new google.maps.Marker({
        position: position,
        map: map
    });
    map.panTo(position);
    marker.setDraggable(true);
    
    var x = document.getElementById("latitude");
var y = document.getElementById("longtitude");
        x.value = marker.getPosition().lat();
    y.value = marker.getPosition().lng();
    latlngChange();
google.maps.event.addListener( marker, 'click', function ( event ) {
    x.value = this.getPosition().lat();
    y.value = this.getPosition().lng();
    latlngChange();
} );  
google.maps.event.addListener( marker, 'dragend', function ( event ) {
    x.value = this.getPosition().lat();
    y.value = this.getPosition().lng();
    latlngChange();
} );  
}
    
                      
                             
    }
    
</script>
<script>
    
    function latlngChange()
    {

        var x = document.getElementById("latitude");
        var y = document.getElementById("longtitude");
        var place1 = document.getElementById("place1");
       
        var geocoder = new google.maps.Geocoder;
    
        var latlng = {lat: parseFloat(x.value), lng: parseFloat(y.value)};
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
    </body>
</html>
