<?php
session_start();
include 'connection.php';

// Check if username is provided
$username = $_SESSION['username'];

// Prepare SQL statement to fetch customer details
$stmt = $con->prepare("SELECT * FROM customer WHERE Username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc();
    echo json_encode($customer);
} else {
    echo json_encode(['error' => 'Customer not found']);
}

$stmt->close();
?>
