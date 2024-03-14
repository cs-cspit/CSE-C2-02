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
        .navbar {
            width: 200px;
            height: 100%;
            background-color: #333;
            position: fixed;
            top: 0;
            left: 0;
        }
        .navbar a {
            display: block;
            color: white;
            padding: 14px 16px;
            text-decoration: none;
            border-bottom: 1px solid #ddd;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

    form {
    width: 95%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    border-radius: 10px;
  }
  label {
    display: block;
    margin-top: 20px;
    font-weight: bold;
  }
  input[type="text"], textarea {
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

    </style>
</head>
<body>
  <?php
    echo'<div class="navbar">
        <a href="#">Profile</a>
        <a href="comp_detail.php">Complaints</a>
        <a href="#">Complaint History</a>
        <a href="admin_logout.php">Logout</a>
    </div>';
  ?>  

</body>
</html>