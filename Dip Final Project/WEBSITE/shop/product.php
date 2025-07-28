<?php
// product.php

include 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $con->prepare("SELECT * FROM shop_filter WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    echo json_encode($product);
} else {
    echo json_encode(['error' => 'No product ID provided']);
}
?>
