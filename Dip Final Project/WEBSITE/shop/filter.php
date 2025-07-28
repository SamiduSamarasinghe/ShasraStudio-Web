<?php
// filter.php

include 'connection.php';

$sql = "SELECT * FROM shop_filter";
$result = $con->query($sql);

$products = array();
while($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>
