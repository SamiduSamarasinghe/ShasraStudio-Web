<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

// Retrieve customer full name
$query = "SELECT Full_Name FROM customer WHERE Username = ?";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($full_name);
    $stmt->fetch();
    $stmt->close();
}

$estimates = [];

// Retrieve pending estimates for the logged-in customer
$query = "SELECT id, full_name, event_type, photography_type, expected_cost, status FROM estimate_bill WHERE full_name = ? AND status = 'Pending'";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $full_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $estimates[] = $row;
    }
    $stmt->close();
}

echo json_encode($estimates);
$con->close();
?>
