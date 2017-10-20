<?php
   include('session.php');
   $user_sql = "SELECT * FROM user_details WHERE email = '$login_session'";
   $run_user_sql = mysqli_query($db, $user_sql);
   $row = mysqli_fetch_array($run_user_sql, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Job Test</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
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
<div class="card-row">
    <div class="col s12 m12 l12">
        <div class="card" style="box-shadow: 5px 5px 5px 5px darkgrey;padding:20px;background: burlywood;">
            <div class="card-image" style="border-bottom: 5px solid darksalmon;">
            <img src="document/picture/<?=isset($row['picture'])?$row['picture']:'default.png';?>" class="user-image">
            <a href="./crop/index.php" class="upload-picture">Upload Picture</a>
            </div>
            <div class="card-content" style="padding:30px 0px 0px 0px;">
                <div class="row">
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p><b>Name: </b><?=isset($row['name'])?$row['name']:'';?></p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p><b>Email: </b><?=isset($row['email'])?$row['email']:'';?></p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p><b>Phone: </b><?=isset($row['phone'])?$row['phone']:'';?></p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p><b>Address: </b><?=isset($row['address'])?$row['address']:'';?></p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p><b>State: </b><?=isset($row['state'])?$row['state']:'';?></p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p><b>City: </b><?=isset($row['city'])?$row['city']:'';?></p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p>
                            <b>Resume: </b>

                            <?=isset($row['resume'])?$row['resume']:''?>
                            <a href="resume.php" class="upload_resume">Upload <?php if($row['resume']!=''){echo 'New Resume';}else{echo 'Resume';}?></a>
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-6" style="padding-bottom:5%;">
                        <p>
                            <b>Voice: </b>
                            <?=isset($row['voice'])?$row['voice']:''?>
                            <a href="voice.php" class="upload_voice">Upload <?php if($row['voice']!=''){echo 'New Voice';}else{echo 'Voice';}?></a>
                        </p>
                    </div>
                    <div class="col-md-12 text-center" style="padding-bottom:5%;">
                        <p><b>Created At: </b><?=isset($row['created_at'])?$row['created_at']:'';?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>