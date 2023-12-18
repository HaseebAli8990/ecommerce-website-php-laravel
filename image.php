<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$dbname = "shop";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT image_path FROM products WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $imageData = $row['image_path'];

            // Output image to the browser
            header("Content-type: image/jpeg");
            readfile($imageData);
            exit; // Stop further execution after sending the image
        } else {
            echo "Image not found";
        }
    } else {
        echo "Error fetching image: " . $conn->error;
    }
}

$conn->close();
?>
