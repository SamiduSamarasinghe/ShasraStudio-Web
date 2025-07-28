<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $customer_username = $_POST['customer_username'];
    $product_ids = explode(',', $_POST['product_ids']);
    $product_quantities = json_decode($_POST['product_quantities'], true);
    $total_price = $_POST['total_price'];
    $email = $_POST['email'];
    $card_number = $_POST['card_number'];
    $cvc = $_POST['cvc'];
    $payment_method = $_POST['payment_method'];
    $name_on_card = $_POST['name_on_card'];
    $billing_address = $_POST['billing_address'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];

    // Insert order details into rent_order table
    $rent_date = date('Y-m-d');
    $rent_status = 'Pending';

    // Start transaction
    $con->begin_transaction();

    try {
        foreach ($product_ids as $product_id) {
            $quantity = $product_quantities[$product_id];
            $rent_price = getItemPrice($product_id) * $quantity;

            $stmt = $con->prepare("INSERT INTO rent_order (customer_username, item_id, rent_days, rent_price, email, card_number, cvc, payment_method, name_on_card, billing_address, city, postal_code, rent_date, rent_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception($con->error);
            }

            $stmt->bind_param("siidssssssssss", $customer_username, $product_id, $quantity, $rent_price, $email, $card_number, $cvc, $payment_method, $name_on_card, $billing_address, $city, $postal_code, $rent_date, $rent_status);

            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            }

            $order_id = $stmt->insert_id;
            $stmt->close();
        }

        // Commit transaction
        $con->commit();

        // Send success response
        echo json_encode(['success' => true, 'order_id' => $order_id]);
    } catch (Exception $e) {
        // Rollback transaction
        $con->rollback();

        // Send error response
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

// Function to get item price
function getItemPrice($item_id) {
    global $con;
    $stmt = $con->prepare("SELECT per_night_price FROM rent_items WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();
    return $price;
}
?>