<?php
// get_inquiries_history.php

session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

// Retrieve completed inquiries for the logged-in user
$stmt = $con->prepare("SELECT * FROM contact_us WHERE customer_username = ? AND status = 'Completed'");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$inquiries = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$con->close();

// Output inquiries as JSON
header('Content-Type: application/json');
echo json_encode($inquiries);
?>
