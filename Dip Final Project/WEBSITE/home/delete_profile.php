<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

$data = json_decode(file_get_contents("php://input"), true);
$fullName = $data['fullName'];

$sql = "DELETE FROM customer WHERE Full_Name = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $fullName);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Profile deleted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting profile.']);
}

$stmt->close();
$con->close();
?>
