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

// Check if the form data is received
if (isset($_POST['postText']) && isset($_POST['postFeeling'])) {
    $postText = $conn->real_escape_string($_POST['postText']);
    $postFeeling = $conn->real_escape_string($_POST['postFeeling']);
    
    // Handle file upload
    $postImage = NULL;
    if (isset($_FILES['postImage']) && $_FILES['postImage']['error'] == 0) {
        $targetDir = "uploads/"; // Folder to store images
        $targetFile = $targetDir . basename($_FILES["postImage"]["name"]);
        if (move_uploaded_file($_FILES["postImage"]["tmp_name"], $targetFile)) {
            $postImage = $targetFile;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO posts (post_text, post_image, feeling_activity) 
            VALUES ('$postText', '$postImage', '$postFeeling')";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }
}

$conn->close();
?>
