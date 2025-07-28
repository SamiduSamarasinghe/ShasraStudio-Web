<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartItems = json_decode(file_get_contents('php://input'), true)['cartItems'] ?? [];
    $_SESSION['rentCartItems'] = $cartItems;
    echo json_encode(['success' => true]);
} elseif (isset($_GET['load'])) {
    $cartItems = $_SESSION['rentCartItems'] ?? [];
    echo json_encode(['rentCartItems' => $cartItems]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>