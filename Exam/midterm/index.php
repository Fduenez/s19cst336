<!DOCTYPE html>
<html>
    <head>
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
          <link rel="stylesheet" href="css/styles.css" type="text/css" />
          <script>
                /*global $*/

                $(document).ready(function()
                {
                    var id = 1;
                    $.ajax({
                        type:"GET",
                        url: "api/getUser.php",
                        dataType:"json",
                        success:function(data, status)
                        {
                           $("#img").html('<img id="img1" src='+ data[id]['picture_url'] +'/>');
                           $("#name").html("about @" +data[id]['username']);
                            $("#bio").html(data[id]['about_me']);
                        }
                        
                    });
                        
                    // });
                    $("#dislike").on("click", function()
                    {
                        $.ajax({
                            type:"GET",
                            url: "api/getUser.php",
                            dataType:"json",
                            success:function(data, status)
                            {
                                id++;
                                $("#img").html('<img id="img1" src='+ data[id]['picture_url'] +'/>');
                                $("#name").html("about @" +data[id]['username']);
                                $("#bio").html(data[id]['about_me']);
                            }
                        
                    });
                    });
                    $("#like").on("click", function()
                    {
                        $.ajax({
                            type:"GET",
                            url: "api/getUser.php",
                            dataType:"json",
                            success:function(data, status)
                            {
                                id++;
                                $("#img").html('<img id="img1" src='+ data[id]['picture_url'] +'/>');
                                $("#name").html("about @" +data[id]['username']);
                                $("#bio").html(data[id]['about_me']);
                            }
                        
                    });
                    });
                    $("#skip").on("click", function()
                    {
                        $.ajax({
                            type:"GET",
                            url: "api/getUser.php",
                            dataType:"json",
                            success:function(data, status)
                            {
                                id++;
                                $("#img").html('<img id="img1" src='+ data[id]['picture_url'] +'/>');
                                $("#name").html("about @" +data[id]['username']);
                                $("#bio").html(data[id]['about_me']);
                            }
                        
                    });
                    });
                    $("#history").on("click", function()
                    {
                        

                        $.ajax({
                            type:"GET",
                            url: "api/getMatch.php",
                            dataType:"json",
                            success:function(data, status)
                            {
                                $("#buttons").html("");
                                $("h1").html("History");
                                $("#content").html("<table id='tab'>");
                                data.forEach(function(key){
                                    $("#tab").append("<tr> <td> " + key['username'] + "</td> </tr>");
                                });
                                
                            }
                        
                    });
                    });
                   
                });
            </script>
    </head>
    <body>
        <div>
                <button id="match">match</button>
                <button id="history">history</button>
        </div>
        <div>
            <h1>Match</h1>
        </div>
        <div id ="content">
            <div id="img">
                
            </div>
            <div id="about">
                <p id= "name"> </p>
                <p id="bio"></p>
            </div>
        </div>
        <div>
            <div id="buttons">
                <button id="dislike">dislike</button>
                <button id="skip">?</button>
                <button id="like">like</button>
            </div>
            
        </div>
        
    </body>
</html>