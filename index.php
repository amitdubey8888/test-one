<?php
  include("config.php");
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $name_arr = array();
    $name_arr[0] = $first_name;
    $name_arr[1] = $last_name;
    $name = implode(' ', $name_arr);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']); 
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $state = isset($_POST['state'])?$_POST['state']:'';
    $city = isset($_POST['city'])?$_POST['city']:'';
    $created_at = date("l jS \of F Y h:i:s A");

    if($name != '' && $email != '' && $password != '' && $phone != '' && $address != '' && $state != '' && $city != ''){
        $sql = "INSERT INTO user_details (name, email, password, phone, address, state, city, picture, resume, voice, created_at) VALUES ('$name','$email','$password','$phone','$address','$state','$city','default.png','','','$created_at')";
        $result = mysqli_query($db,$sql);
        if($result) {
            session_start();
            $_SESSION['email'] = $email;
            echo "<script>window.open('welcome.php','_self')</script>";
        }else {
            $error = "Sign up failed, Please try again!";
        }
    }else{
        $error = "All fields are mandatory!";
    }
  }
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
    <script src="main.js"></script>
</head>
<body>
  <!-- Sign Up Module Start -->
    <div class="container">
        <h4 class="signup">Sign UP</h4>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" onkeyup="checkme()">
                    <small id="ferror"></small>
                </div>
                <div class="col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" onkeyup="checkme()">
                    <small id="lerror"></small>
                </div>
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" onkeyup="checkme()">
                    <small id="emailerror"></small>
                </div>
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" onkeyup="checkme()">
                    <small id="passworderror"></small>
                </div>
                <div class="col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" onkeyup="checkme()">
                    <small id="phoneerror"></small>
                </div>
                <div class="col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address">
                </div>
                <script src="state.js"></script>
                <div class="col-md-6">
                    <label for="state">State</label>
                    <select class="form-control" name="state" id="state" onchange='select_state(this.value)'></select>
                </div>
                <div class="col-md-6">
                    <label for="city">City</label>
                    <select class="form-control" name="city" id='city'></select>
                </div>
                <small class="smallerror"><?=isset($error)?$error:'';?></small>
                <div class="col-md-12" style="margin-top:5%;text-align:center;">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>
        </form>
  <!-- Sign Up Module End -->
</body>
</html>
