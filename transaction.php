<?php
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

$sql = "SELECT invoice_number, patient_id, patient_name, total_amount, status FROM transactions";
$result = $conn->query($sql);

$transactions = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $transactions[] = $row;
    }
}

echo json_encode($transactions);

$conn->close();
?>
