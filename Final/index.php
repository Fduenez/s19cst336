<?php

  session_start();
  if(isset($_SESSION))
  {
    $username = ($_SESSION['username']);
  }else{
    $username = "";
  }
?>



<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/index.css" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    </head>
    
    
    <body id = container>
        
        <div id="login">
    
        </div>
   
        <div id="box">

            <div id="centerBox">
                <label for="invitation">Invitation link</label>
                <input type="text" id="invitation" aria-label="Small">      <i class="far fa-copy" onClick="copy()"></i>
                
            </div>
        </div>
            <div class="modal" tabindex="-1" role="dialog" id="add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div>
                              <input type="text" id="datepicker" width="276" />
                          </div>
                        <div>
                            <span>Start Time</span> <input type="time" id=startTime>
                        </div>
                         <div>
                            <span> End Time </span><input type="time" id= "endTime">
                        </div>
                        <div>

                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="modal" tabindex="-1" role="dialog" id="remove">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Remove</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          
                          <div id="modalStartTime"></div>
                          <div id="modalEndTime"></div>
                          <div>
                              <label>are you sure you want to delete this time slot? this cannot be undone.</label>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onClick='deleteSlotButtonClicked()'>delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                </div>
            </div>
        
        <div>
            <table id="slots">
                <tr>
                    <th>date</th>
                    <th>start time</th>
                    <th>duration</th>
                    <th>booked by</th>
                    <th>
                       <a href="#" onClick="addSlot()" > add multiple time slots  </a><i class="fas fa-plus"></i>
                    </th>
                    
                </tr>
                
            </table>
        </div>
        
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    
    <script>
    /*global $*/
    
    
        var identification=0;
    
        var username;
    
    
        function addSlot()
        {
            $('#add').modal({
              keyboard: false
            })
        }
        function copy()
        {
            var copyText = document.getElementById("invitation");
        
          /* Select the text field */
            copyText.select();
        
          /* Copy the text inside the text field */
            document.execCommand("copy");
        }
        
        $(document).ready(function(){
            $('#remove').modal('hide');
            
                
            username = "<?php echo $username?>";
        if(username == ""){
            $("#login").append("<a href='register.php' > Sign up </a>");
            $("#login").append("<a href='login.php' > Log In </a>");
            $("#login").append("<a href='rubric.php' > Rubric </a>");
          console.log("empty");
        }
        else{
        
            $("#login").append("<a href='signOut.php' > Sign Out </a>");
            $("#login").append("<a href='rubric.php' > Rubric </a>");
            console.log(username);
        }
    
            
            
            
            
            $('#datepicker').datepicker({
                dateFormat: "mm/dd/yyyy",
                uiLibrary: 'bootstrap4'
            });
            $.ajax({
                type: "POST",
                url: "api/select.php",
                data: {},
                dataType: "json",
                success: function(data, status) 
                {
                    console.log(data);
                    for(var i = 0; i < data.length; i++)
                    {
                        $("#slots").append(" <tr> <td> " + data[i]['date'] + "</td> <td>" + data[i]['start_time'] + "</td> <td>" + data[i]['duration']   + "</td> <td>" +data[i]['bookedBy'] + "</td> <td>  <button type = 'button' onClick = 'deleteSlot(" + data[i]['id'] + ")'> Details  </button> <button type = 'button' onClick = 'deleteSlot(" + data[i]['id'] + ")' > Delete  </button> </td> </tr>");
                        
                    }
                }
            });
        });
        
        function deleteSlotButtonClicked(){
            console.log("im in boss!");
            $.ajax({
                type: "POST",
                url: "api/deleteRow.php",
                data: {'id' : identification},
                dataType: "json",
                success: function(data, status) 
                {
                    
                }
            });
            location.reload();
            
        }
        
        
        function deleteSlot(id)
        {
            $("#modalStartTime").html("");
            $("#modalEndTime").html("");
            identification = id;
            
             $.ajax({
                type: "POST",
                url: "api/selectRow.php",
                data: {'id': id},
                dataType: "json",
                success: function(data, status) 
                {
                    console.log(data);
                    $('#remove').modal('show');
                    $("#modalStartTime").append("<p> Start Time " + data[0]['date']  + " " + data[0]['start_time'] + "</p>");
                    $("#modalEndTime").append("<p> Duration " + data[0]['duration'] + "</p>");
                    
                }
                });
                
            
            
        }
        
        $("#save").on('click', function()
        {
            if($("#datepicker").val() == "")
            {
                console.log("Error: date required");
            }
            else if($("#startTime").val() == "")
            {
                console.log("Error: start time required");
            }
            else if($("#endTime").val() == "")
            {
                console.log("Error: end time required");
            }
            else
            {
                var end =$("#endTime").val();
                var start = $("#startTime").val();
                
                var startT = start.split(":");
                
                var endT = end.split(":");
                var differenceHour = "";
                var differenceMin = "";
                if((parseInt(endT[0]) - parseInt(startT[0])) < 0 )
                {
                    console.log("Error: you have inserted a time that has passed");
                }
                else if((parseInt(endT[1]) - parseInt(startT[1])) < 0 )
                {
                    differenceMin = 60 - Math.abs(parseInt(endT[1]) - parseInt(startT[1]));
                    differenceHour = parseInt(endT[0]) - parseInt(startT[0])-1;
                    
                     var strTime = differenceHour.toString() + " hour " + differenceMin.toString() + " min";
                    
                    $.ajax({
                    type: "POST",
                    url: "api/insert.php",
                    data: {
                        "date":$("#datepicker").val(),
                        "start_time": start,
                        "duration": strTime,
                        "bookedBy": "Not Booked",
                        "username": username,
                    },
                    dataType: "json",
                    success: function(data, status) 
                    {
                    }
                    });
                    
                    location.reload();
                    
                    
                    
                    
                }
                else
                {
                    differenceHour = parseInt(endT[0]) - parseInt(startT[0]);
                    differenceMin = Math.abs(parseInt(endT[1]) - parseInt(startT[1]));
                    
                    
                    
                    
                    var strTime = differenceHour.toString() + "hour " + differenceMin.toString() + "min";
                    
                    $.ajax({
                    type: "POST",
                    url: "api/insert.php",
                    data: {
                        "date":$("#datepicker").val(),
                        "start_time": start,
                        "duration": strTime,
                        "bookedBy": "Not Booked",
                        "username": username,
                    },
                    dataType: "json",
                    success: function(data, status) 
                    {
                    }
                    });
                    
                    location.reload();
                }
            }
                
        });
        
        
        
        
    </script>
</html>

