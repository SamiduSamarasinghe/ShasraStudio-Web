<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

$data = json_decode(file_get_contents("php://input"), true);

$fullName = $data['user'];
$address = $data['address'];
$email = $data['envelope'];
$phone = $data['phone'];
$password = $data['key'];

$sql = "UPDATE customer SET Address = ?, Email = ?, Phone_Number = ?, Password = ? WHERE Username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssss", $address, $email, $phone, $password, $username);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating profile.']);
}

$stmt->close();
$con->close();
?>
