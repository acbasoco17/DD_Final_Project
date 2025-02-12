<?php 
require 'index.php';
if (!isset($_SESSION['email'])) {
    header("location: sign_in.html");
}

$username = $_SESSION['email'];
$reviewTxt = $_POST['review'];
$id = $_GET['id'];

$review_query = "SELECT * FROM `Reviews` WHERE `id` = '$id' AND `username` = '$username'";
$review_result = mysqli_query($con, $review_query) or die(mysqli_error($con));

if (mysqli_num_rows($review_result) == 0) {
    $insert = "INSERT INTO `Reviews` (`username`, `id`, `review`, `rating`) VALUES ('$username', '$id', '$review', NULL)";
    mysqli_query($con, $insert);
    header("location: song.php?id=$id");
}

$review = mysqli_fetch_row($review_result);
$update = "UPDATE `Reviews` SET `review` = \"$reviewTxt\" WHERE `id` = '$id' AND `username` = '$username'";
mysqli_query($con, $update);
header("location: song.php?id=$id");
?>