<?php
session_start();
include 'connection.php'; // Ensure this file contains your database connection logic

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

// Retrieve customer full name
$sql = "SELECT Full_Name FROM customer WHERE Username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$stmt->bind_result($full_name);
$stmt->fetch();
$stmt->close();

// Retrieve completed estimates for the logged-in customer
$sql = "SELECT id, full_name, event_type, estimated_cost, created_at FROM estimate_bill WHERE full_name = ? AND status = 'Completed'";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $full_name);
$stmt->execute();
$result = $stmt->get_result();

$estimates = [];
while ($row = $result->fetch_assoc()) {
    $estimates[] = $row;
}

$stmt->close();
$con->close();

header('Content-Type: application/json');
echo json_encode($estimates);
?>
