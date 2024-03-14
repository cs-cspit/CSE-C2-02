<?php
error_reporting(0);
    $name=$_POST['fullName'];
    $username=$_POST['userName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conn=mysqli_connect('localhost','root','','test');
    if($conn)
    {
            $sql = "SELECT * FROM signup WHERE userName = '$username' OR email = '$email';";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            if (mysqli_num_rows($result) > 0) {
                // OUTPUT DATA OF EACH ROW
                while($row = mysqli_fetch_assoc($result)) {
                    if($username==$row['userName'])
                    {
                        
                         $i=$i+1;
                    }
                    if($email==$row['email'])
                    {
                        $j=$j+1;
                    }
                }
            }
            if ($count >= 1) {
                if($i>=1)
                {
                    echo "<script>alert('failed to register as username already exist');</script>";
                    header("Location:http://localhost/Temp/user/signup.html");
                    exit();
                }
                else if($j>=1)
                {
                    echo "<script>alert('failed to register as email already exist');</script>";
                    header("Location:http://localhost/Temp/user/signup.html");
                exit();
                }
                else{
                    echo "<script>alert('failed to register as both email and name exist');</script>";
                    header("Location:http://localhost/Temp/user/signup.html");
                exit();
                }
                
                header("Location:http://localhost/Temp/test.html");
                
            }
             else {
                echo "<script>alert('registered successfully');</script>";
                $pass=password_hash($password, PASSWORD_DEFAULT);
        $query="insert into signup values ('NULL','$name','$username','$email','$pass')";
        mysqli_query($conn,$query);
        header("Location:http://localhost/Temp/user/login.html");
    exit();
    }
}
else
{
	echo 'connection is failed';
}

?> 
