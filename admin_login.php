<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "bookmydoctor"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function login($email, $password) {
    global $conn;
    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $admin['email'];
            header("Location: index.html"); 
            exit();
        } else {
            return "Invalid password.";
        }
    } else {
        return "No admin found with this email.";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginMessage = login($email, $password);
    if ($loginMessage !== null) {
        echo "<p>$loginMessage</p>";
    }
}
$conn->close();
?>
