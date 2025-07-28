<?php
include 'connection.php';

// Check if product ID is provided
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare SQL statement to fetch product details
    $stmt = $con->prepare("SELECT * FROM rent_items WHERE item_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'No product ID provided']);
}
?>
