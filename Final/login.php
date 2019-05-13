
<!--Lv62Qu98hIIPzgrRAqg4EG6P--> 
<!--new secret-->
<?php
// Start the session
session_start();
?>




</body>
</html>
<html>
  <head>
    <title>Sign In</title>
    <meta name="viewport" content="initial-scale=1.0">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="155697290910-40pgod6lgqt3jpo5o339t5bj4rk3vqea.apps.googleusercontent.com">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>



    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/signin.css">

  </head>
  <body>
    


    <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">  

            <h1>Sign In Page</h1>
          <form class="form-signin">
            <div class="form-label-group">
              <label>username: </label><input id="username" type="text" class="form-control"></input>
            </div>
            <div class="form-label-group">
              <label>Password: </label><input id="pswd" type="password" class="form-control"></input>
            </div>
              <div id="result"></div>
              <button id="normalS" type = "button" class="btn btn-lg btn-primary btn-block text-uppercase">Sign In</button>
              <!--<div id="google"class="g-signin2" data-onsuccess="onSignIn" ></div>-->
              <!--<div class="fb-login-button" data-width="" data-size="medium" data-button-type="login_with" data-auto-logout-link="true" data-use-continue-as="false"></div>-->
              <!--<a href="#" onclick="signUp();">Sign up</a>-->
          </form>
        </div>
      </div>
    </div>
    </div>
  </div>


  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    
    $("#normalS").on('click', function(){
        var username= $("#username").val();
        var pass= $("#pswd").val();
      
          
        $.ajax({
            type: "POST",
            url: "api/signIn.php",
            data: { "username": username,"password":pass },
            dataType: "json",
            success: function(data, status) 
            {
                window.location = "index.php";
            }
        });
    });
    
    </script>

  </body>
</html>