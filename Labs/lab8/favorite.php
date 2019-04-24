<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Favorite</title>
  <!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->
</head>

<body id="dummybodyid">
  <h1> Favorite </h1>

  <form>
    <fieldset>
      <legend>Favorite</legend>
      <div>
          <label>search images:</label><input type="text" id="query">
          <button type = button id = "button">submit</button>
          <div id="box"> 
          
          </div>
          <div id="box2">
            
          </div>
          <div id="box3">
            
          </div>
              
      </div>
        
    </fieldset>
  </form>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>
  
                $("#button").on("click", function(e)
                {
                  $("#box").html("");
                  $("#box2").html("");
                  $("#box3").html("");
                  $.ajax
                  ({
                    type:"GET",
                    url: "pixabay.php",
                    dataType:"json",
                    data:
                    {
                      "key": "12231164-6bc585a61279f768cb9c6f5b0",
                      "query": $("#query").val()
                    },
                    success:function(data, status)
                    {
                      console.log(data);
                        for(var i = 0; i < 9; i += 3)
                        {
                          $("#box").append('<img src= "' + data[i]['largeImageURL'] + '" width="300" />');
                          $("#box2").append('<img src="' + data[i +1]['largeImageURL'] + '" width="300"/>');
                          $("#box3").append('<img src="' + data[i + 2]['largeImageURL'] + '" width="300"/>');
                        }
                    } ,
                   complete: function(status, err){
                     console.log(status);
                   } 
                  });
                });
  </script>
</body>

</html>