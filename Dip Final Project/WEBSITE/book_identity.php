<?php
// book_identity.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $photo_type = $_POST['photo'];
    $photo_size = $_POST['size'];
    $photo_quantity = $_POST['qty'];
    $booking_datetime = $_POST['time'];
    $special_requirements = $_POST['others'];

    if (empty($full_name) || empty($photo_type) || empty($photo_size) || empty($photo_quantity) || empty($booking_datetime)) {
        echo 'All fields marked as required must be filled.';
        exit();
    }

    // Retrieve the price of the selected photo type
    $stmt = $con->prepare("SELECT price FROM identification_photography WHERE photo_type = ?");
    $stmt->bind_param("s", $photo_type);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    if (!$price) {
        echo 'Invalid photo type selected.';
        exit();
    }

    // Calculate the total cost
    $total_cost = $price * $photo_quantity;

    // Insert the new booking into the database
    $stmt = $con->prepare("INSERT INTO booking_identity (full_name, photo_type, photo_size, photo_quantity, booking_datetime, special_requirements, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiisd", $full_name, $photo_type, $photo_size, $photo_quantity, $booking_datetime, $special_requirements, $total_cost);

    if ($stmt->execute()) {
        echo 'Booking successful!';
    } else {
        echo 'Booking failed. Please try again later.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/service_page/identity.html");
    exit();
}
?>
