<?php 
require 'index.php';
    $username = $_SESSION['email'];
    $destination = $_SESSION['destination'];
    $friend = $_GET['friend'];
    $sql = "DELETE FROM `Friends` WHERE `username_user` = '$username' AND `username_friend` = '$friend'";
    mysqli_query($con, $sql);
    header("location: $destination");
?>