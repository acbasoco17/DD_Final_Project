<?php
require 'index.php';
unset($_SESSION['username'], $_SESSION['user_id']);
session_destroy();

header("location: sign_in.html");
?>
