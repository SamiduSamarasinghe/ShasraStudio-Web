<?php
session_start();
header('Content-Type: application/json');
include 'db_connection.php';

$conn = OpenCon();

$employee_full_name = $_SESSION['full_name'];

$sql = "SELECT Task_Subject as subject, Task_Description as description FROM employee_tasks WHERE Employee_Full_Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $employee_full_name);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }
}

echo json_encode($tasks);

CloseCon($conn);
?>
