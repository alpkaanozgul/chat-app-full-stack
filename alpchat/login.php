<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "alpchat_users1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email1'];
$password_plain = $_POST['password1']; // Store the plain password for verification

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND authentication_flag = 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if a matching record was found
if ($result->num_rows == 1) {
    // Verify hashed password
    $row = $result->fetch_assoc();
    $password_hashed = $row['password']; // Get the hashed password from the database
    if (password_verify($password_plain, $password_hashed)) {
        echo "Login successful";
    } else {
        echo "Error: Invalid email or password"; 
    }
} else {
    echo "Error: Invalid email or password"; 
}

$stmt->close();
$conn->close();

?>
