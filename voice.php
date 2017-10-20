<?php
    include('session.php');
    $user_sql = "SELECT * FROM user_details WHERE email = '$login_session'";
    $run_user_sql = mysqli_query($db, $user_sql);
    $row = mysqli_fetch_array($run_user_sql, MYSQLI_ASSOC);

    $session_id=isset($_SESSION['email'])?$_SESSION['email']:'';
    $path = "document/voice/";

    if(isset($_POST['submit']))
    {
        $allowedExts = array("mp3", "mp4", "webm", "ogv");
        $temp = explode(".", $_FILES["voice"]["name"]);
        $extension = end($temp);

        $name = $_FILES['voice']['name'];
        $tmp = $_FILES['voice']['tmp_name'];
        if(strlen($name))
        {
            if(($_FILES["voice"]["type"] == "video/mp3")
            || ($_FILES["voice"]["type"] == "video/mp4")
            || ($_FILES["voice"]["type"] == "video/webm")
            || ($_FILES["voice"]["type"] == "video/ogv")
            && ($_FILES["voice"]["size"] < 2147483648)
            && in_array($extension, $allowedExts))
            {
                if(move_uploaded_file($tmp, $path.$name))
                {
                    mysqli_query($db, "UPDATE user_details SET voice='$name' WHERE email='$session_id'");
                    echo "<script>window.open('welcome.php','_self');</script>";
                }
                else 
                $failederror = "Failed!";
            }
            else
            $failederror = "Invalid voice formats!";
        }
        else
        $failederror = "Please select voice..?";
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
    <link rel="stylesheet" href="style.css">
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
            <a class="nav-link" href="welcome.php" style="color:aliceblue;">Welcome
                <?=$row['name'].'!';?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color:aliceblue;">Logout</a>
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
<div class="upload-voice-card">
    <form method="post" enctype="multipart/form-data">
        <label for="voice">Upload your voice
            </label> 
        <input type="file" name="voice" id="voice"/>
        <input type="submit" name="submit" class="btn btn-primary" value="Upload"/> 
    </form>
</div>
</body>
</html>