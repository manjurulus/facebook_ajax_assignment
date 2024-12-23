<?php
// Database connection details
$host = 'localhost';       // Change this to your database host
$username = 'root';        // Your database username
$password = '';            // Your database password
$dbname = 'ashrafulsir'; // Your database name

// Create a new MySQL connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to create the posts table
$sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_text TEXT NOT NULL,
    post_image VARCHAR(255) DEFAULT NULL,
    feeling_activity VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Execute the query and check if the table was created successfully
if ($conn->query($sql) === TRUE) {
    echo "Table 'posts' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
