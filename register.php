<!DOCTYPE HTML>

<?php
session_start();
require_once __DIR__ . '/Facebook/autoload.php'; // change path as needed
require 'connect.php';

$fb = new \Facebook\Facebook([
  'app_id' => '161713021336907',
  'app_secret' => 'e4dbd79e0e6da4d75019803b487214d2',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

?>

<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">
        
    </head>

    <body data-ma-theme="green">
        
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                
                <div class="login__block__header">
                    <img src="https://graph.facebook.com/<?php echo $_SESSION['user_id']; ?>/picture?type=normal">
                     ลงทะเบียนระบบคู่มือเต่าทะล
                </div>
                <br>
                <form action="doRegister.php" method="post">
                <div class="form-group form-group--float form-group--centered">
                        <input type="text" name="firstname" class="form-control">
                        <label>ชื่อ</label>
                        <i class="form-group__bar"></i>
                </div>
                <div class="form-group form-group--float form-group--centered">
                        <input type="text" name="lastname" class="form-control">
                        <label>นามสกุล</label>
                        <i class="form-group__bar"></i>
                </div>
                <div class="form-group form-group--float form-group--centered">
                        <input type="text" name="nickname" class="form-control">
                        <label>ชื่อเล่น</label>
                        <i class="form-group__bar"></i>
                </div>
                <div class="form-group form-group--float form-group--centered">
                        <input type="text" name="email" class="form-control">
                        <label>Email</label>
                        <i class="form-group__bar"></i>
                </div>
                <div class="form-group form-group--float form-group--centered">
                        <input type="text" name="phone" class="form-control">
                        <label>หมายเลขโทรศัพท์</label>
                        <i class="form-group__bar"></i>
                </div>
                <button id="login" type="submit" class="btn btn-primary btn-outline btn-lg"> ลงทะเบียนและเข้าสู่ระบบ </button>
                </form>
            </div>
        </div>

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

        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
        
        
    </body>
</html>
