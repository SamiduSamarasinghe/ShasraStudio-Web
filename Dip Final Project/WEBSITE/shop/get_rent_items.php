<?php
include 'connection.php';

$query = "SELECT * FROM rent_items";
$result = $con->query($query);

$items = array();

while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

echo json_encode($items);
?>
