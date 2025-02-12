<?php 
require 'index.php';
    $username = $_SESSION['email'];
    $destination = $_SESSION['destination'];
    $id = $_GET['id'];
    $sql = "INSERT INTO `Music_Listened_To` (`username`, `id`) VALUES ('$username', '$id')";
    mysqli_query($con, $sql);
    header("location: $destination");
?>