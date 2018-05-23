
<?php
session_start();


    session_destroy();
 
    //header('Location:login.php');
?>

<html>
<body>

    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '161713021336907',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.0'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
        
    FB.logout(function(response) {
  // user is now logged out
        alert("logout");
});
</script>
</body>
</html>