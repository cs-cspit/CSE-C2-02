<?php
session_start(); // Start session to manage user login state

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and password from form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'test');

    // Check if connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL query to select user with given email
    $sql = "SELECT * FROM signup WHERE email = '$email'";
    
    // Execute SQL query
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Check if user exists with the given email
        if (mysqli_num_rows($result) == 1) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);
            // Verify password
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['id']; 
                $_SESSION['email'] = $email;
                // Redirect user to dashboard or any other page
                header("Location: complaint.php");
                exit();
            } else {
                // Password is incorrect
                $showError = "Invalid Password";
            }
        } else {
            // User with given email does not exist
            $showError = "User with this email does not exist";
        }
    } else {
        // Error executing SQL query
        $showError = "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>
