<?php
session_start();
include 'connection.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT o.order_id, o.product_ids, o.product_quantities, o.total_price, o.order_date, o.status
          FROM shop_order o
          WHERE o.customer_username = ? AND o.status = 'Completed'";

if ($stmt = $con->prepare($query)) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = array();

    while ($row = $result->fetch_assoc()) {
        $order_id = $row['order_id'];
        $product_ids = explode(',', $row['product_ids']);
        $product_quantities = json_decode($row['product_quantities'], true);

        $products = array();
        foreach ($product_ids as $product_id) {
            $product_query = "SELECT name FROM shop_filter WHERE id = ?";
            if ($product_stmt = $con->prepare($product_query)) {
                $product_stmt->bind_param('i', $product_id);
                $product_stmt->execute();
                $product_result = $product_stmt->get_result();
                if ($product_row = $product_result->fetch_assoc()) {
                    $products[] = array(
                        'name' => $product_row['name'],
                        'quantity' => $product_quantities[$product_id]
                    );
                }
                $product_stmt->close();
            }
        }

        $orders[] = array(
            'order_id' => $row['order_id'],
            'products' => $products,
            'total_price' => $row['total_price'],
            'order_date' => $row['order_date'],
            'status' => $row['status']
        );
    }

    echo json_encode($orders);
    $stmt->close();
}

$con->close();
?>
