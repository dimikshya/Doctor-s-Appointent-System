<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "bookmydoctor"; // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to create an admin user
function createAdminUser($email, $plaintextPassword) {
    global $conn;
    $hashedPassword = password_hash($plaintextPassword, PASSWORD_DEFAULT);
    $sql = "INSERT INTO admin (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashedPassword);
    if ($stmt->execute()) {
        return "New admin user created successfully!";
    } else {
        return "Error: " . $stmt->error;
    }
}

// Define email and password for the new admin
$email = 'dimikshya@admin.com';
$plaintextPassword = 'admin123';

// Create the admin user
echo createAdminUser($email, $plaintextPassword);

// Close the connection when the script ends
$conn->close();
?>
