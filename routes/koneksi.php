<?php
// Database configuration
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "tasty_food";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $email = $_POST['email'];

    $sql = "INSERT INTO contacts (nama, subject, message, email) VALUES ('$nama', '$subject', '$message', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
