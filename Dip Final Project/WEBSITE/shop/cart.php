<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_image = $_POST['product_image'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];

    // Check if the product already exists in the cart
    $stmt = $con->prepare("SELECT * FROM carts WHERE username = ? AND product_id = ?");
    $stmt->bind_param("si", $username, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the quantity if the product already exists
        $stmt = $con->prepare("UPDATE carts SET quantity = quantity + ? WHERE username = ? AND product_id = ?");
        $stmt->bind_param("isi", $quantity, $username, $product_id);
    } else {
        // Insert a new product into the cart
        $stmt = $con->prepare("INSERT INTO carts (username, product_id, product_name, product_image, product_price, quantity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissdi", $username, $product_id, $product_name, $product_image, $product_price, $quantity);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => 'Product added to cart']);
    } else {
        echo json_encode(['error' => 'Failed to add product to cart']);
    }

    $stmt->close();
    $con->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Retrieve cart items for the logged-in user
    $stmt = $con->prepare("SELECT * FROM carts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $cart_items = [];
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }

    echo json_encode($cart_items);

    $stmt->close();
    $con->close();
}
?>
