<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'test');
session_unset();
header("Location: login.html");
?>