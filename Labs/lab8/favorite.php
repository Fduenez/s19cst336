<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Favorite</title>
  <!--<link href="css/styles.css" rel="stylesheet" type="text/css" />-->
  
  <style>
    img{
      height: 300px;
    }
    .heart{
      display: block;
      height: 50px;
      width: 50px;
      margin: 0 auto;
    }
    .col{
      display: flex;
    }
  </style>
</head>

<body id="dummybodyid">
  <h1> Favorite </h1>

  <form>
    <fieldset>
      <legend>Favorite</legend>
      
      <label>search images:</label><input type="text" id="query">
      <button type = button id = "button">submit</button>
      <div id="container"> </div>
        
    </fieldset>
  </form>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>
  
                $("#button").on("click", function(e)
                {
                  $("#container").empty();
                  
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
                        for(var i = 0; i < 9; i += 3)
                        {
                          var col = document.createElement("div");
                          col.setAttribute("class", "col");
                          
                          for(var j=0; j < 3; j++){

                            var d = document.createElement("div");
                            d.setAttribute("background-color", "black");
                            d.setAttribute("width", "300px");
      
                            var img = document.createElement("img");
                            img.setAttribute("src", data[i+j]['largeImageURL']);
                            
                            var heart = document.createElement("img");
                            heart.setAttribute("src","favorite-on.png");
                            heart.setAttribute("class","heart");
                            
                            d.appendChild(img);
                            d.appendChild(heart);
          
                            col.appendChild(d);
                          }
                          
                          $("#container").append(col);
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

<!-- https://s19cst336-frankduenez.c9users.io/s19cst336/Labs/lab8/favorite.php -->
<!-- https://github.com/Fduenez/s19cst336/tree/master/Labs/lab8 -->
<!--http://fduenez-s19cst336.herokuapp.com/Labs/lab8/favorite.php-->
