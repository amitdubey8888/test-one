<?php
   include('config.php');
   
   session_start();
   
   $email = $_SESSION['email'];
   
   $ses_sql = mysqli_query($db,"select email from user_details where email = '$email'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   
   if(!isset($_SESSION['email'])){
      header("location:index.php");
   }
?>
