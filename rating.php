<?php
require 'index.php';
$username = $_SESSION['email'];
$id = (int) $_GET['id'];
$star = (int) $_GET['star'];

$review_query = "SELECT * FROM `Reviews` WHERE `id` = '$id' AND `username` = '$username'";
$review_result = mysqli_query($con, $review_query) or die(mysqli_error($con));

if (mysqli_num_rows($review_result) == 0) {
    $insert = "INSERT INTO `Reviews` (`username`, `id`, `review`, `rating`) VALUES ('$username', '$id', NULL, '$star')";
    mysqli_query($con, $insert);
    header("location: song.php?id=$id");
}

$review = mysqli_fetch_row($review_result);
$update = "UPDATE `Reviews` SET `rating` = $star WHERE `id` =  '$id' AND `username` = '$username'";
mysqli_query($con, $update);
header("location: song.php?id=$id");

?>