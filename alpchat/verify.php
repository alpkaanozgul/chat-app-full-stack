<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "alpchat_users1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET["token"]) && isset($_GET["email"])) {
    $received_token = $_GET["token"];
    $received_email = $_GET["email"];

-    $sql = "SELECT * FROM users WHERE authentication_token = '$received_token' AND email = '$received_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql_update = "UPDATE users SET authentication_flag = 1 WHERE authentication_token = '$received_token' AND email = '$received_email'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Verification successful. Update authentication flag.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Verification failed. Token and email do not match.";
    }
} else {
    echo "Token or email not found in URL.";
}

$conn->close();
?>
