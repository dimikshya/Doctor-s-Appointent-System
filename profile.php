<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "bookmydoctor";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id = 1; 
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $user = [
        'name' => 'Unknown',
        'email' => 'unknown@example.com',
        'location' => 'N/A',
        'bio' => 'N/A',
        'dob' => 'N/A',
        'mobile' => 'N/A',
        'address' => 'N/A'
    ];
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($user);
?>
