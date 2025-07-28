<?php
session_start();
include 'connection.php';

// Check if order ID is provided
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Prepare SQL statement to fetch order details
    $stmt = $con->prepare("SELECT * FROM shop_order WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo json_encode($order);
    } else {
        echo json_encode(['error' => 'Order not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'No order ID provided']);
}
?>
