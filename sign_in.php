<?php 
require 'index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];
}
$date = date('Y-m-d');

$query = "SELECT * FROM `User` WHERE `username` = '$email' AND `pswd` = '$password'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
  
  $_SESSION['email'] = $email;
  $_SESSION['name']  = $name;
  header("location: music.php");
} else {
  ?>
  <script type="text/javascript"> alert("Email or password is incorrect"); history.go(-1);</script>
  <?php
}
?>