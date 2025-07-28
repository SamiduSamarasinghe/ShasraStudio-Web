<?php
// contact_us.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $inquiry = $_POST['inquiry'];
    $customer_username = $_SESSION['username'];
    
    // Prepare and bind the SQL statement
    $stmt = $con->prepare("INSERT INTO contact_us (first_name, last_name, address, email, contact_no, inquiry, customer_username) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $first_name, $last_name, $address, $email, $contact_no, $inquiry, $customer_username);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'Inquiry submitted successfully.';
    } else {
        echo 'Error: ' . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}
?>
