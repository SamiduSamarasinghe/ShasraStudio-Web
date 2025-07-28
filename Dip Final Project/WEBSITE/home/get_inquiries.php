<?php
// get_inquiries.php

session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

// Retrieve inquiries for the logged-in user
$stmt = $con->prepare("SELECT id, first_name, last_name, inquiry, date, status FROM contact_us WHERE customer_username = ? AND status = 'Pending'");
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
