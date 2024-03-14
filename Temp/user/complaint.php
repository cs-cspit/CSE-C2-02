<?php
include 'nav.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('location: login.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    if(isset($_SESSION['id'])) {
      $uid = $_SESSION['id'];
  } else {
      // Redirect if user ID is not set in session
      header('location: login.html');
      exit();
  }


    $category = $_POST["category"];
    $area = $_POST["area"];
    $description = $_POST["description"];
    // $uid = $_SESSION['id']; // Assuming you have 'id' stored in the session

    // Check if image file is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Set target file path for image upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Upload image file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Connect to MySQL database (replace dbname, username, password with your actual database credentials)
            $conn = new mysqli("localhost", "root", "", "test");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO complaints (uid, category, area, description, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $uid, $category, $area, $description, $target_file);

            // Execute SQL statement
            if ($stmt->execute()) {
              //  echo "Complaint submitted successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No image uploaded.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            width: 95%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div style="margin-left: 200px;">
        <!-- Your main content goes here -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category"><br>
            <label for="area">Area:</label>
            <input type="text" id="area" name="area"><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea><br>
            <label for="image">Upload Image:</label><br>
            <input type="file" id="image" name="image"><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
