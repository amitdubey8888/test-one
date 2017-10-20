<?php
    include('../session.php');
    $user_sql = "SELECT * FROM user_details WHERE email = '$login_session'";
    $run_user_sql = mysqli_query($db, $user_sql);
    $row = mysqli_fetch_array($run_user_sql, MYSQLI_ASSOC);

    $session_id=isset($_SESSION['email'])?$_SESSION['email']:'';
    $path = "../document/picture/";
    $valid_formats = array("jpg", "png", "gif", "bmp");
    if(isset($_POST['submit']))
    {
        $name = $_FILES['photoimg']['name'];
        $size = $_FILES['photoimg']['size'];
        if(strlen($name))
        {
            list($txt, $ext) = explode(".", $name);
            if(in_array($ext,$valid_formats) && $size<(250*1024))
            {
                $actual_image_name = time().substr($txt, 5).".".$ext;
                $tmp = $_FILES['photoimg']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_image_name))
                {
                    mysqli_query($db, "UPDATE user_details SET picture='$actual_image_name' WHERE email='$session_id'");
                    $image="<h4 style='text-align:center;padding:20px;'>Please drag on the image to crop image!</h4><img src='../document/picture/".$actual_image_name."' id=\"photo\">";
                }
                else 
                $failederror = "Failed!";
            }
            else
            $failederror = "Invalid image formats!";
        }
        else
        $failederror = "Please select image..?";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Test</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.imgareaselect.pack.js"></script>
    <link rel="stylesheet" href="../style.css">
    <script>
        function getSizes(im,obj)
        {
            var x_axis = obj.x1;
            var x2_axis = obj.x2;
            var y_axis = obj.y1;
            var y2_axis = obj.y2;
            var thumb_width = obj.width;
            var thumb_height = obj.height;
            if(thumb_width > 0)
            {
                if(confirm("Do you want to save image..?"))
                {
                    $.ajax({
                        type:"GET",
                        url:"ajax_image.php?t=ajax&img="+$("#image_name").val()+"&w="+
                        thumb_width+"&h="+thumb_height+"&x1="+x_axis+"&y1="+y_axis,
                        cache:false,
                        success:function(rsponse)
                        {
                            window.open('../welcome.php', '_self');
                        }
                    });
                }
            }
            else alert("Please select portion..?");
        }
        $(document).ready(function(){
            $('img#photo').imgAreaSelect({
                aspectRatio: '1:1',
                onSelectEnd: getSizes
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-toggleable-md" style="background:#ee6e73;">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" style="color:aliceblue;">Dashboard</a>
    <div class="collapse navbar-collapse" id="navbarText">
    <span class="navbar-text">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="../welcome.php" style="color:aliceblue;">Welcome
                <?=$row['name'].'!';?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../logout.php" style="color:aliceblue;">Logout</a>
        </li>
        </ul>
    </span>
    </div>
</nav>
<h6 style="text-align:center; color:red; padding:20px;">
<?php
    if(isset($failederror)){echo $failederror;}
?>
</h6>
<?php
    if(isset($image)){
        echo $image;
    }else{
?>
<div class="upload-image-card">
    <form id="cropimage" method="post" enctype="multipart/form-data">
        <label for="photoimg">Upload your image</label> 
        <input type="file" name="photoimg" id="photoimg"/>
        <input type="hidden" name="image_name" id="image_name" value="<?php echo($actual_image_name)?>" />
        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Upload"/> 
    </form>
</div>
<?php }; ?>
</body>
</html>