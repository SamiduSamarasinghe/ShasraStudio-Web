<?php
// book_event.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $event_type = $_POST['event'];
    $location = $_POST['location'];
    $event_datetime = $_POST['time'];
    $event_date = date('Y-m-d', strtotime($event_datetime)); // Extracting the date part
    $crowd_quantity = $_POST['crowd'];
    $photography_type = $_POST['service'];
    $expected_cost = $_POST['cost'];
    $other_wantings = $_POST['others'];
    $event_description = $_POST['description'];

    if (empty($full_name) || empty($event_type) || empty($location) || empty($event_datetime) || empty($crowd_quantity) || empty($photography_type) || empty($expected_cost)) {
        echo 'All fields marked as required must be filled.';
        exit();
    }

    // Check if the event date is already booked
    $stmt = $con->prepare("SELECT * FROM booking WHERE DATE(event_datetime) = ?");
    $stmt->bind_param("s", $event_date);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Sorry for the inconvenience. The selected date is already booked. Please choose another date if possible.';
        $stmt->close();
        $con->close();
        exit();
    }
    $stmt->close();

    // Insert the new booking into the database
    $stmt = $con->prepare("INSERT INTO booking (full_name, event_type, location, event_datetime, crowd_quantity, photography_type, expected_cost, other_wantings, event_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssissss", $full_name, $event_type, $location, $event_datetime, $crowd_quantity, $photography_type, $expected_cost, $other_wantings, $event_description);

    if ($stmt->execute()) {
        echo 'Booking successful!';
    } else {
        echo 'Booking failed. Please try again later.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/service_page/event.html");
    exit();
}
?>
