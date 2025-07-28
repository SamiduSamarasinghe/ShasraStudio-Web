<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT Full_Name, Username, Address, Phone_Number, Email, Password FROM customer WHERE Username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'profile' => $row]);
} else {
    echo json_encode(['success' => false, 'message' => 'Profile not found.']);
}

$stmt->close();
$con->close();
?>
