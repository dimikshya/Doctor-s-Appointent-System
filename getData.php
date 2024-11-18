<?php
include 'db.php';
$result = $conn->query("SELECT COUNT(*) AS count FROM doctors");
$doctorsCount = $result->fetch_assoc()['count'];
$result = $conn->query("SELECT COUNT(DISTINCT patient_name) AS count FROM appointments");
$patientsCount = $result->fetch_assoc()['count'];
$result = $conn->query("SELECT COUNT(*) AS count FROM appointments");
$appointmentsCount = $result->fetch_assoc()['count'];
$result = $conn->query("SELECT SUM(amount) AS total FROM appointments");
$totalRevenue = $result->fetch_assoc()['total'];
$doctorsList = [];
$doctorsQuery = $conn->query("SELECT name, revenue, rating FROM doctors");
while($row = $doctorsQuery->fetch_assoc()) {
    $doctorsList[] = $row;
}
$appointmentsList = [];
$appointmentsQuery = $conn->query("SELECT doctor_name, patient_name, appointment_time, amount FROM appointments");
while($row = $appointmentsQuery->fetch_assoc()) {
    $appointmentsList[] = $row;
}
$data = [
    'summary' => [
        'doctors' => $doctorsCount,
        'patients' => $patientsCount,
        'appointments' => $appointmentsCount,
        'revenue' => $totalRevenue
    ],
    'doctorsList' => $doctorsList,
    'appointmentsList' => $appointmentsList
];

echo json_encode($data);

$conn->close();
?>
