<?php
// estimate_bill.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $event_type = $_POST['event'];
    $location = $_POST['location'];
    $crowd_quantity = $_POST['crowd'];
    $photography_type = $_POST['photography_type'];
    $expected_cost = $_POST['cost'];
    $about_event = $_POST['about'];

    if (empty($full_name) || empty($event_type) || empty($location) || empty($crowd_quantity) || empty($photography_type) || empty($expected_cost) || empty($about_event)) {
        echo 'All fields marked as required must be filled.';
        exit();
    }

    // Insert the new estimate request into the database
    $stmt = $con->prepare("INSERT INTO estimate_bill (full_name, event_type, location, crowd_quantity, photography_type, expected_cost, about_event) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisds", $full_name, $event_type, $location, $crowd_quantity, $photography_type, $expected_cost, $about_event);

    if ($stmt->execute()) {
        echo 'Estimate request submitted successfully!';
    } else {
        echo 'Estimate request submission failed. Please try again later.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/service_page/estimate.html");
    exit();
}
?>
