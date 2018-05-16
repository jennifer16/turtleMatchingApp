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
                    <h1><a href="index.html"><img src="img/noun_1546379_cc.png"><b>คู่มือเต่าทะเล</b></a></h1>
                    
                </div>

                <ul class="top-nav">
                    <li class="top=nav">
                    <a href=''><i class="zmdi zmdi-camera-add"></i> </a>
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
                            <a class="dropdown-item" href="">ดูรายละเอียด</a>
                            <a class="dropdown-item" href="">ออกจากระบบ</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li class="navigation__active"><a href="index.html"><i class="zmdi zmdi-home"></i> หน้าหลัก</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-view-week"></i> ข้อมูลเต่าทั้งหมด</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-replay"></i> ประวัติการพบเต่า</a></li>
                        
                        <li><a href="#"><i class="zmdi zmdi-camera-add"></i> ค้นหาเต่าด้วยรูปภาพ</a></li>
                        <?php
                            if ($_SESSION['user_role']==1)
                            {
                                echo "<li class='navigation__sub'>";
                                echo "<a href=''><i class='zmdi zmdi-collection-text'></i> จัดการข้อมูลเต่า</a>";
                                echo "<ul>";
                                echo "<li><a href='addTurtle.php'>เพิ่มข้อมูลเต่า</a></li>";
                                echo "<li><a href=''>แก้ไขข้อมูลเต่า</a></li>";
                                echo "<li><a href=''>ลบข้อมูลเต่า</a></li>";
                                echo "</ul>";
                                echo "</li>";
                            }
                        ?>
                        
                        <?php
                            if ($_SESSION['user_role']==1)
                            { echo "<li><a href='#'><i class='zmdi zmdi-layers'></i> เต่าที่พบในธรรมชาติ</a></li>" };
                        ?>
                        
                        <?php
                            if ($_SESSION['user_role']==1)
                            { echo "<li><a href='#'><i class='zmdi zmdi-repeat'></i> ข้อมูลแม่เต่าที่ขึ้นมาวางไข่</a></li>" };
                        ?>
                        
                        <li><a href="#"><i class="zmdi zmdi-email"></i> ติดต่อเรา</a></li>

                    </ul>
                </div>
            </aside>

          <section class="content">


      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">เพิ่มข้อมูลเต่า</h3>
                  <div id="container_image"></div> 
              </div>
              <!-- /.card-header -->
              <!-- form start --> 
                <div class="container">
    <label class="label" data-toggle="tooltip" title="คลิกเพื่อเลือกรูปภาพ">ภาพถ่ายเต่าด้านซ้าย<br>
      <img class="rounded" id="avatarLeft" src="img/camera.png" style="max-width:100%; height:auto;" alt="avatar">
      <input type="file" class="sr-only" id="inputLeft" name="imageLeft" accept="image/*">
    </label>
      <input type="text" name="filenameLeft" id="filenameLeft" hidden>
    <div class="alertLeft" role="alert"></div>
    <div class="modal fade" id="modalLeft" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">เลือกส่วนเกล็ดบนใบหน้าเต่า</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
              <img id="imageLeft" src="https://avatars0.githubusercontent.com/u/3456749">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" id="cropLeft">ตกลง</button>
          </div>
        </div>
      </div>
    </div>
  </div>

                
 <div class="container">
    <label class="label" data-toggle="tooltip" title="คลิกเพื่อเลือกรูปภาพ">ภาพถ่ายเต่าด้านขวา<br>
      <img class="rounded" id="avatarRight" src="img/camera.png" style="max-width:100%; height:auto;" alt="avatar">
      <input type="file" class="sr-only" id="inputRight" name="imageLeft" accept="image/*">
    </label>
      <input type="text" name="filenameRight" id="filenameRight" hidden>
    <div class="alertRight" role="alert"></div>
    <div class="modal fade" id="modalRight" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">เลือกส่วนเกล็ดบนใบหน้าเต่า</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
              <img id="imageRight" src="https://avatars0.githubusercontent.com/u/3456749">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" id="cropRight">ตกลง</button>
          </div>
        </div>
      </div>
    </div>
  </div>

              <form role="form" action = "doAddTurtle.php" method = "POST" enctype = "multipart/form-data">
                <div class="card-body">

                  <label>ด้านของใบหน้าเต่า</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="side" value="LEFt" checked>
                      <label class="form-check-label">หน้าด้านซ้าย</label> <br>
                       <input class="form-check-input" type="radio" name="side"  value="RIGHT">
                      <label class="form-check-label">หน้าด้านขวา</label>
                    </div>
                    <br>                
                    <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                    <label for="latitude">ละติจูด</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="0.00">
                        </div>
                        <div class="col-md-6">
                    <label for="latitude">ลองจิจูด</label>
                    <input type="text" class="form-control" id="longtitude" name="longtitude" placeholder="0.00">
                        </div>
                  </div>
                        </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">ค้นหา</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.row -->
    <!-- /.content -->
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
        
  <script src="js/cropper.js"></script>
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatarLeft');
      var image = document.getElementById('imageLeft');
      var input = document.getElementById('inputLeft');
      var $alert = $('.alertLeft');
      var $modal = $('#modalLeft');
      var cropper;
      var newFilename;
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
        var newFilenameLeft;

        if (files && files.length > 0) {
          file = files[0];
          filename = file.name;
          $fileext = filename.split('.').pop();
          var text = "";
          var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

          for (var i = 0; i < 10; i++)
             text += possible.charAt(Math.floor(Math.random() * possible.length));

          $newFilename = text+'.'+$fileext;
          document.getElementById("filenameLeft").value = $newFilenameLeft;

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

      document.getElementById('cropLeft').addEventListener('click', function () {
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
	
            
            formData.append('avatar', blob);
            formData.append('filename', $newFilenameLeft);

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
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('avatarRight');
      var image = document.getElementById('imageRight');
      var input = document.getElementById('inputRight');
      var $alert = $('.alertRight');
      var $modal = $('#modalRight');
      var cropper;
      var newFilename;
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
        var newFilenameRight;

        if (files && files.length > 0) {
          file = files[0];
          filename = file.name;
          $fileext = filename.split('.').pop();
          var text = "";
          var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

          for (var i = 0; i < 10; i++)
             text += possible.charAt(Math.floor(Math.random() * possible.length));

          $newFilename = text+'.'+$fileext;
          document.getElementById("filenameRight").value = $newFilenameLeft;

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

      document.getElementById('cropRight').addEventListener('click', function () {
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
	
            
            formData.append('avatar', blob);
            formData.append('filename', $newFilenameRight);

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
var position = {
    coords: {
        latitude: '',
        longitude: ''
    }
};

$.getJSON("https://api.ipdata.co/", function (data, status) {
    if(status === "success") {
        if(data.latitude && data.longitude) {
            //if there's not zip code but we have a latitude and longitude, let's use them
            x.value = data.latitude;
            y.value = data.longitude;
        } else {
            alert("ไม่สามารถดึงพิกัดได้ \n กรุณากรอกด้วยตนเอง");
        }
    }
       
    
});


</script>
    </body>
</html>