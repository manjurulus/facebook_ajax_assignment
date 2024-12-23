<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'ashrafulsir';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts from the database
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($sql);

$posts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

echo json_encode($posts);

$conn->close();
?>
