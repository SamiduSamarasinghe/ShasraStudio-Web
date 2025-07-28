<?php
session_start();
header('Content-Type: application/json');
include 'db_connection.php';

$conn = OpenCon();

$employee_full_name = $_SESSION['full_name'];

$sql = "SELECT Message_Subject as subject, Message_Description as description, Received_Date as received_date FROM employee_messages WHERE Employee_Full_Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $employee_full_name);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);

CloseCon($conn);
?>
