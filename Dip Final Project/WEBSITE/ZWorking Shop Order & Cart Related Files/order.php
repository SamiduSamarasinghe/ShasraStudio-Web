<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_username = $_SESSION['username'];
    $product_ids = $_POST['product_ids'];
    $product_quantities = $_POST['product_quantities'];
    $total_price = $_POST['total_price'];
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $cvc = $_POST['cvc'];
    $payment_method = $_POST['payment_method'];
    $name_on_card = $_POST['name_on_card'];
    $billing_address = $_POST['billing_address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];

    $stmt = $con->prepare("INSERT INTO shop_order (customer_username, product_ids, product_quantities, total_price, email, card_number, cvc, payment_method, name_on_card, billing_address, city, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdssssssss", $customer_username, $product_ids, $product_quantities, $total_price, $email, $card_number, $cvc, $payment_method, $name_on_card, $billing_address, $city, $postal_code);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        echo json_encode(['success' => true, 'order_id' => $order_id]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
}
?>
