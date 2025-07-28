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

$bookings = [];

// Retrieve completed bookings from booking table
$query = "SELECT 'Event Photography' AS booking_type, booking_id, full_name, event_type, location, event_datetime, status FROM booking WHERE full_name = ? AND status = 'Completed'";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $full_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    $stmt->close();
}

// Retrieve completed bookings from booking_identity table
$query = "SELECT 'Identification Photography' AS booking_type, id AS booking_id, full_name, photo_type, booking_datetime, status FROM booking_identity WHERE full_name = ? AND status = 'Completed'";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $full_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    $stmt->close();
}

// Retrieve completed bookings from booking_studio_outdoor table
$query = "SELECT 'Studio & Outdoor Photography' AS booking_type, id AS booking_id, full_name, request_type AS event_type, booking_datetime, status FROM booking_studio_outdoor WHERE full_name = ? AND status = 'Completed'";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $full_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    $stmt->close();
}

// Retrieve completed bookings from booking_wedding table
$query = "SELECT 'Wedding Photography' AS booking_type, id AS booking_id, full_name, event_type, location, event_datetime, status FROM booking_wedding WHERE full_name = ? AND status = 'Completed'";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $full_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    $stmt->close();
}

echo json_encode($bookings);
$con->close();
?>
