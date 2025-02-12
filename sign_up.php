<?php

require 'index.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
}
$date = date('Y-m-d');

$query = "SELECT * FROM `User` WHERE `username` = '$email'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    ?>
    <script type="text/javascript"> alert("Email already has an account associated"); history.go(-1);</script>
    <?php
} else {
    $sql = "INSERT INTO `User` (`username`, `fname`, `pswd`, `account_created`) VALUES ('$email', '$name', '$password', '$date')";

    $rs = mysqli_query($con, $sql);

    $_SESSION['email'] = $email;
    $_SESSION['name']  = $name;

    header('location: music.php');
}
?>