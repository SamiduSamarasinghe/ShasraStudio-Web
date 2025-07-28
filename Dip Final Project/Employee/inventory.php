<?php
session_start();
header('Content-Type: application/json');
include 'db_connection.php';

$conn = OpenCon();

$sql = "SELECT id, name, category, price, description, quantity FROM shop_filter";
$result = $conn->query($sql);

$inventory = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $inventory[] = $row;
    }
}

echo json_encode($inventory);

CloseCon($conn);
?>
