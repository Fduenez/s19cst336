<!DOCTYPE html>
<html>

<head>
    <title>AJAX POST File Upload</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <div class="col-md-3">
            <form method="POST" enctype="multipart/form-data">
                <div>
                    <label>email:</label> <input type="text" name="email"/>
                </div>
                
                <textarea name="textbox" cols="40" rows="4" placeholder="insert caption"> </textarea> 
                <br>
                
                <div style="display:none;">
                    <input type="file" multiple name="fileName" />
                </div>

                <div>
                    <button id="selectButton" type="button" class="btn btn-primary btn-xs">Pick File(s)</button>
                </div>
                <div id="filesList">
                </div>
                <div>
                    <button id="uploadButton" type="button" class="btn btn-primary btn-xs">Upload File(s)</button>
                </div>
                
            </form>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>
            <div id="results">
                
            </div>
            <div id="outer_wrapper">
                <div id="inner_wrapper">
                     <?php
                        
                        if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
                            $db = mysqli_connect($url["host"], $url["user"], $url["pass"], substr($url["path"], 1)); 
                        } 
                        else
                            $db = mysqli_connect("localhost","root","","event_picture_dump"); 
                        $sql = "SELECT * FROM upload WHERE 1";
                        $sth = $db->query($sql);
                        echo "<div id='box'>";
                        while($result=mysqli_fetch_array($sth))
                        {
                            echo "<div>";
                            echo '<img style="height:300px;width:auto "src="data:image/jpeg;base64,'.base64_encode( $result['media'] ).'"/>';
                            echo "</div>";
                        }
                        echo "</div>";

                     ?>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript">
        /* global $ */
            // 1. Get rid of file input button
            //$("form button:nth-of-type(1)").click(function() {
            $("#selectButton").click(function() {
                console.log("clicked")
                $("form input[type='file']").trigger("click")
            })

            // 2. Use ajax to submit files
            $("form input[type='file']").change(function(e) {
                $('#filesList').empty();
                $.map(this.files, function(val) {
                    $('#filesList')
                        .append($('<div>')
                            .html(val.name)
                        );
                });
            })

            // 3. Send files with ajax
            $('#uploadButton').click(function(e) {
                setProgress(0);
                var formData = new FormData($('form')[0]);
                $.ajax({
                        url: "uploadFiles.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        mimeType: "multipart/form-data",
                        cache: false,
                        // This part gives up chunk progress of the file upload
                        xhr: function() {
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    setProgress(percent);
                                }, true);
                            }
                            return xhr;
                        }
                    })
                    .done(function(data, status, xhr) {
                        console.log('upload done');
                        //window.location.href = "<?php echo BASE_PATH?>/assets/<?php echo $controller->group ?>";
                        console.log(xhr);
                        $("#results").html(xhr.responseText)
                    })
                    .fail(function(xhr) {
                        console.log('upload failed');
                        console.log(xhr);
                    })
                    .always(function() {
                        //console.log('done processing upload');
                    });
            });

            function setProgress(percent) {
                $(".progress-bar").css("width", +percent + "%");
                $(".progress-bar").text(percent + "%");
            }
        </script>
</body>

</html>


<!-- http://fduenez-s19cst336.herokuapp.com/projects/project5/ -->
<!-- https://github.com/Fduenez/s19cst336/tree/master/projects/project5 -->
<!--https://s19cst336-frankduenez.c9users.io/s19cst336/projects/project5/ -->