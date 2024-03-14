<?php
include 'admin_nav.php';
// Database connection parameters
session_start();

if (!isset($_SESSION['Adminloggedin'])) {
    header('location: Admin_login.html');
    exit();
}
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$database = "test"; // Replace with your actual database name
$table = "complaints"; // Replace with your actual table name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the table and join with another table
$sql = "SELECT complaints.uid, complaints.category, complaints.area, complaints.description,complaints.image ,signup.name,signup.email
        FROM complaints
        LEFT JOIN signup ON complaints.uid = signup.id"; // Replace other_table and column_name with the appropriate table and column names

$result = $conn->query($sql);

// Output CSS for table styling
echo "<style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin-left: 220px; /* Add space below the table */
        }
        
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        tr:hover {
            background-color: #ddd;
        }
      </style>";
$num=1;
// Output the table
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>";
    echo "<tr><th>No.</th><th>Name</th><th>Email</th><th>Category</th><th>Area</th><th>Description</th><th>Image</th></tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $num. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["category"]. "</td><td>" . $row["area"]. "</td><td>" . $row["description"]. "</td><td>" . $row["image"]. "</td></tr>";
        // Adjust field names as per your table structure
        $num=$num+1;
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
