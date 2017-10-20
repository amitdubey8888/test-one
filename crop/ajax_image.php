<?php
include('../config.php');
session_start();
$session_id=$_SESSION['email'];
$t_width = 100;
$t_height = 100;
$new_name = $session_id.".jpg";
$path = "../document/picture/";
if(isset($_GET['t']) and $_GET['t'] == "ajax")
{
extract($_GET);
$ratio = ($t_width/$w); 
$nw = ceil($w * $ratio);
$nh = ceil($h * $ratio);
$nimg = imagecreatetruecolor($nw,$nh);
$im_src = imagecreatefromjpeg($path.$img);
imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w,$h);
imagejpeg($nimg,$path.$new_name,90);
mysqli_query($db, "UPDATE user_details SET picture='$new_name' WHERE email='$session_id'");
echo $new_name."?".time();
exit;
}
?>