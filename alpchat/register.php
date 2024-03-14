<?php
error_reporting(E_ALL); 

// Function to retrieve client IP address considering proxy servers
function getClientIp() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $authentication_token = $_POST["authentication_token1"];
    $authentication_flag = $_POST["authentication_flag"];

    $user_ip = getClientIp();


    // Encrypt the password using bcrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $servername = "127.0.0.1";
    $db_username = "root";
    $db_password = "";
    $dbname = "alpchat_users1";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $check_email_sql = "SELECT id FROM users WHERE email = ?";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $check_email_result = $check_email_stmt->get_result();

    if ($check_email_result->num_rows > 0) {
        $response = array("error" => "Email already exists in the database");
        echo json_encode($response);
    } else {
        
        $insert_sql = "INSERT INTO users (username, email, password, authentication_flag, authentication_token, user_ip) VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssssss", $username, $email, $hashed_password, $authentication_flag, $authentication_token, $user_ip);

        if ($stmt->execute() === TRUE) {
            $response = array("success" => "New record created successfully");
            echo json_encode($response);
        } else {
            $response = array("error" => "Error: " . $insert_sql . "<br>" . $conn->error);
            echo json_encode($response);
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo "Invalid request";
}
?>
