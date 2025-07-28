<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sahasrastudiodb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $fullName = $_GET['full_name'];
// $fullName = "Alice Johnson";
$fullName = isset($_GET['fullName']) ? $conn->real_escape_string($_GET['fullName']) : '';

$data = [];

// Fetch orders
$orderQuery = $conn->prepare("SELECT * FROM shop_order WHERE customer_username IN (SELECT Username FROM customer WHERE Full_Name = ?)");
$orderQuery->bind_param("s", $fullName);
$orderQuery->execute();
$orderResult = $orderQuery->get_result();

$orders = [];
while ($row = $orderResult->fetch_assoc()) {
    $orders[] = $row;
}
$data['orders'] = $orders;

// Fetch rentals
$rentalQuery = $conn->prepare("SELECT * FROM rent_order WHERE customer_username IN (SELECT Username FROM customer WHERE Full_Name = ?)");
$rentalQuery->bind_param("s", $fullName);
$rentalQuery->execute();
$rentalResult = $rentalQuery->get_result();

$rentals = [];
while ($row = $rentalResult->fetch_assoc()) {
    $rentals[] = $row;
}
$data['rentals'] = $rentals;

// Fetch booking types
$bookingDates = [];
$eventPhotographyCounts = [];
$identificationPhotographyCounts = [];
$studioOutdoorPhotographyCounts = [];
$weddingPhotographyCounts = [];

// Event Photography
$eventBookingQuery = $conn->prepare("SELECT COUNT(*), event_datetime FROM booking WHERE full_name = ? GROUP BY event_datetime");
$eventBookingQuery->bind_param("s", $fullName);
$eventBookingQuery->execute();
$eventBookingResult = $eventBookingQuery->get_result();
while ($row = $eventBookingResult->fetch_assoc()) {
    $bookingDates[] = $row['event_datetime'];
    $eventPhotographyCounts[] = $row['COUNT(*)'];
}

// Identification Photography
$identBookingQuery = $conn->prepare("SELECT COUNT(*), booking_datetime FROM booking_identity WHERE full_name = ? GROUP BY booking_datetime");
$identBookingQuery->bind_param("s", $fullName);
$identBookingQuery->execute();
$identBookingResult = $identBookingQuery->get_result();
while ($row = $identBookingResult->fetch_assoc()) {
    $identificationPhotographyCounts[] = $row['COUNT(*)'];
}

// Studio & Outdoor Photography
$studioBookingQuery = $conn->prepare("SELECT COUNT(*), booking_datetime FROM booking_studio_outdoor WHERE full_name = ? GROUP BY booking_datetime");
$studioBookingQuery->bind_param("s", $fullName);
$studioBookingQuery->execute();
$studioBookingResult = $studioBookingQuery->get_result();
while ($row = $studioBookingResult->fetch_assoc()) {
    $studioOutdoorPhotographyCounts[] = $row['COUNT(*)'];
}

// Wedding Photography
$weddingBookingQuery = $conn->prepare("SELECT COUNT(*), event_datetime FROM booking_wedding WHERE full_name = ? GROUP BY event_datetime");
$weddingBookingQuery->bind_param("s", $fullName);
$weddingBookingQuery->execute();
$weddingBookingResult = $weddingBookingQuery->get_result();
while ($row = $weddingBookingResult->fetch_assoc()) {
    $weddingPhotographyCounts[] = $row['COUNT(*)'];
}

$data['bookingDates'] = $bookingDates;
$data['eventPhotographyCounts'] = $eventPhotographyCounts;
$data['identificationPhotographyCounts'] = $identificationPhotographyCounts;
$data['studioOutdoorPhotographyCounts'] = $studioOutdoorPhotographyCounts;
$data['weddingPhotographyCounts'] = $weddingPhotographyCounts;

echo json_encode($data);

$conn->close();
?>
