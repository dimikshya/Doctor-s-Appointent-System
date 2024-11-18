<?php
header('Content-Type: application/json'); // Set header for JSON response

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookmydoctor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch appointment data
$sql = "SELECT doctor_name, patient_name, appointment_time, payment_status, amount FROM appointment";
$result = $conn->query($sql);

$appointments = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

echo json_encode($appointments); // Output data as JSON

// Close connection
$conn->close();
?>
