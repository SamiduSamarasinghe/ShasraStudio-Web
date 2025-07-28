<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sahasrastudiodb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Metrics Queries
$totalBookingsPerMonthSql = "
    SELECT MONTH(event_datetime) AS Month, COUNT(*) AS Total_Bookings
    FROM (
        SELECT event_datetime FROM booking
        UNION ALL
        SELECT booking_datetime AS event_datetime FROM booking_identity
        UNION ALL
        SELECT booking_datetime AS event_datetime FROM booking_studio_outdoor
        UNION ALL
        SELECT event_datetime FROM booking_wedding
    ) AS all_bookings
    GROUP BY MONTH(event_datetime)
";

$bookingTypesVariationSql = "
    SELECT 
        MONTH(event_datetime) AS Month,
        SUM(CASE WHEN table_name = 'booking' THEN 1 ELSE 0 END) AS Event_Photography,
        SUM(CASE WHEN table_name = 'booking_identity' THEN 1 ELSE 0 END) AS Identification_Photography,
        SUM(CASE WHEN table_name = 'booking_studio_outdoor' THEN 1 ELSE 0 END) AS Studio_Outdoor_Photography,
        SUM(CASE WHEN table_name = 'booking_wedding' THEN 1 ELSE 0 END) AS Wedding_Photography
    FROM (
        SELECT event_datetime, 'booking' AS table_name FROM booking
        UNION ALL
        SELECT booking_datetime AS event_datetime, 'booking_identity' AS table_name FROM booking_identity
        UNION ALL
        SELECT booking_datetime AS event_datetime, 'booking_studio_outdoor' AS table_name FROM booking_studio_outdoor
        UNION ALL
        SELECT event_datetime, 'booking_wedding' AS table_name FROM booking_wedding
    ) AS all_bookings
    GROUP BY MONTH(event_datetime)
";

// Execute queries
$totalBookingsPerMonthResult = $conn->query($totalBookingsPerMonthSql);
$bookingTypesVariationResult = $conn->query($bookingTypesVariationSql);

// Fetch data
$totalBookingsPerMonth = [];
while ($row = $totalBookingsPerMonthResult->fetch_assoc()) {
    $totalBookingsPerMonth[] = $row;
}

$bookingTypesVariation = [];
while ($row = $bookingTypesVariationResult->fetch_assoc()) {
    $bookingTypesVariation[] = $row;
}

// Close connection
$conn->close();

// Prepare data to be sent as JSON
$data = [
    'totalBookingsPerMonth' => $totalBookingsPerMonth,
    'bookingTypesVariation' => $bookingTypesVariation,
];

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
