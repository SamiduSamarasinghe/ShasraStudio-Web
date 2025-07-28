<?php
// frame_sublimation.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $service_type = $_POST['service_type'];
    $frame_number = isset($_POST['frame_number']) && !empty($_POST['frame_number']) ? $_POST['frame_number'] : null;
    $sublimation_number = isset($_POST['sublimation_number']) && !empty($_POST['sublimation_number']) ? $_POST['sublimation_number'] : null;
    $quantity = $_POST['quantity'];
    $requested_date = $_POST['requested_date'];

    if (empty($full_name) || empty($service_type) || empty($quantity) || empty($requested_date)) {
        echo 'All fields marked as required must be filled.';
        exit();
    }

    // Initialize total cost
    $total_cost = 0;

    // Calculate cost for frames if frame_number is provided
    if ($service_type == 'frame' || ($service_type == 'both' && $frame_number)) {
        $stmt = $con->prepare("SELECT price FROM frames WHERE frame_number = ?");
        $stmt->bind_param("i", $frame_number);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        $stmt->close();

        if (!$price) {
            echo 'Invalid frame number selected.';
            exit();
        }

        $total_cost += $price * $quantity;
    }

    // Calculate cost for sublimations if sublimation_number is provided
    if ($service_type == 'sublimation' || ($service_type == 'both' && $sublimation_number)) {
        $stmt = $con->prepare("SELECT price FROM sublimations WHERE sublimation_number = ?");
        $stmt->bind_param("i", $sublimation_number);
        $stmt->execute();
        $stmt->bind_result($price);
        $stmt->fetch();
        $stmt->close();

        if (!$price) {
            echo 'Invalid sublimation number selected.';
            exit();
        }

        $total_cost += $price * $quantity;
    }

    // Insert the new order into the database
    $stmt = $con->prepare("INSERT INTO frame_sublimation (full_name, service_type, frame_number, sublimation_number, quantity, requested_date, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiisd", $full_name, $service_type, $frame_number, $sublimation_number, $quantity, $requested_date, $total_cost);

    if ($stmt->execute()) {
        echo 'Order placed successfully!';
    } else {
        echo 'Order placement failed. Please try again later.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/service_page/frame.html");
    exit();
}
?>
