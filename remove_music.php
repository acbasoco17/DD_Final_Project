<?php 
require 'index.php';
    $username = $_SESSION['email'];
    $id = $_GET['id'];
    $destination = $_SESSION['destination'];
    $sql = "DELETE FROM `Music_Listened_To` WHERE `username` = '$username' AND `id` = '$id'";
    mysqli_query($con, $sql);
    header("location: $destination");
?>