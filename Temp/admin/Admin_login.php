<?php
$conn = mysqli_connect('localhost', 'root', '', 'test');
$username = $_POST['username'];
$password = $_POST['password'];
if ($conn) {
    $sql = "select * from admin where username='$username' and password='$password';";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        echo "<script>alert('Logged in successfully');</script>";
        session_start();
        $_SESSION['Adminloggedin'] = true;

        header("Location:http://localhost/Temp/admin/com_detail.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        echo "<h1>Login failed. Invalid username or password.</h1>";
        header("Location:http://localhost/Temp/admin/Admin_login.html");
        exit();
    }
} else {
    echo 'Connection failed';
}
?>