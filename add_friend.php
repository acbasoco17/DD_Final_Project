<?php
require 'index.php';
if (!isset($_SESSION['email'])) {
    header("location: sign_in.html");
}
$username = $_SESSION['email'];
$destination = $_SESSION['destination'];
$friend = $_GET['friend'];
$name = $_GET['name'];
$sql = "INSERT INTO `Friends` (`username_user`, `username_friend`, `friend_name`) VALUES ('$username', '$friend', '$name')";
mysqli_query($con, $sql);
header("location: $destination");
