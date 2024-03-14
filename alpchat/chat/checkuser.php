<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "alpchat_users1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email']; // Retrieve email from $_POST array

// Prepare SQL query
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the email exists
if ($result->num_rows > 0) {
    echo "exists";
} else {
    echo "not exists";
}

$stmt->close();
$conn->close();
?>
