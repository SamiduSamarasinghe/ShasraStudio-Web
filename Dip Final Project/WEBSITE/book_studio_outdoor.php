<?php
// book_studio_outdoor.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $request_type = $_POST['event'];
    $location = $_POST['location'];
    $booking_datetime = $_POST['time'];
    $photography_type = $_POST['service'];
    $expected_cost = $_POST['cost'];
    $special_requirements = $_POST['others'];

    if (empty($full_name) || empty($request_type) || empty($location) || empty($booking_datetime) || empty($photography_type) || empty($expected_cost)) {
        echo 'All fields marked as required must be filled.';
        exit();
    }

    $booking_date = date('Y-m-d', strtotime($booking_datetime)); // Extracting the date part

    // Check if the booking date is already booked
    $stmt = $con->prepare("SELECT * FROM booking_studio_outdoor WHERE DATE(booking_datetime) = ?");
    $stmt->bind_param("s", $booking_date);
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
    $stmt = $con->prepare("INSERT INTO booking_studio_outdoor (full_name, request_type, location, booking_datetime, photography_type, expected_cost, special_requirements) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $full_name, $request_type, $location, $booking_datetime, $photography_type, $expected_cost, $special_requirements);

    if ($stmt->execute()) {
        echo 'Booking successful!';
    } else {
        echo 'Booking failed. Please try again later.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/service_page/studio.html");
    exit();
}
?>
