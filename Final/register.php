<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>

<body>
    
    <div class="container" id="wrap">
	  <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form  method="post" accept-charset="utf-8" class="form" role="form">
                    <br /> <br />
                   <legend>Sign Up</legend>
                    <input type="text" name="username" value="" class="form-control input-lg" placeholder="Username"  />
                    <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password"  />
                    <input type="password" name="confirmation" value="" class="form-control input-lg" placeholder="Confirm Password"  />
                    <div class="row">
                        <div class="col-xs-4 col-md-4">
                                            </div>
                        <div class="col-xs-4 col-md-4">
                   </div>
                    </div>
                     
                    <br />
              <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
                    
            <button id="signupButton" class="btn btn-lg btn-primary btn-block signup-btn" type="submit">Create my account</button>
        
                <div id="message" role="alert">
            
            </div>
            </form>          
          </div>
    </div>            
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
            $("#signupButton").on('click', function(e) {
                e.preventDefault();

                
                var pass = $("input[name='password']").val();
                var cpass = $("input[name='confirmation']").val();
                
                if(pass == ""){
                    $("#message").html("Invalid Password");
                    return;
                }
                if(cpass == ""){
                    $("#message").html("Invalid Confirmation Password");
                    return;
                }
                if(pass != cpass){
                    $("#message").html("Password confirmation Does Not Match Password");
                    return;
                }
                
                $.ajax({
                    type: "POST",
                    url: "api/signUP.php",
                    dataType: "json",
                    data: {
                        "username": $("input[name='username']").val(),
                        "password": $("input[name='password']").val(),
                        "confirmation": $("input[name='confirmation']").val(),
                    },
                    success: function(data, status) {
                        console.log("inside function    ");
                        console.log(data);
                        if (data.isSignedUp) {
                            window.location = "index.php";
                            $("#message").html("Account successful");
                        }
                        else {
                            $("#message").html("Error: " + data.message);
                            $("#message").removeClass("open-hidden");
                        }
                    },
                    error: function() { 
                        console.log(arguments);
                    },
                    complete: function(data, status) { //optional, used for debugging purposes
                        console.log(status);
                    }
                });
            })

</script>


    
    
</body>

</html>