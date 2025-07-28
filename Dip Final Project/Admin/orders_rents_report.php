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
$totalOrdersRentsPerMonthSql = "
    SELECT Month, SUM(Total_Orders) AS Total_Orders, SUM(Total_Rents) AS Total_Rents
    FROM (
        SELECT MONTH(order_date) AS Month, COUNT(*) AS Total_Orders, 0 AS Total_Rents
        FROM shop_order
        GROUP BY MONTH(order_date)
        UNION ALL
        SELECT MONTH(rent_date) AS Month, 0 AS Total_Orders, COUNT(*) AS Total_Rents
        FROM rent_order
        GROUP BY MONTH(rent_date)
    ) AS orders_rents
    GROUP BY Month
";

$cityDistributionSql = "
    SELECT city, SUM(Total_Orders) AS Total_Orders, SUM(Total_Rents) AS Total_Rents
    FROM (
        SELECT city AS city, COUNT(*) AS Total_Orders, 0 AS Total_Rents
        FROM shop_order
        GROUP BY city
        UNION ALL
        SELECT city AS city, 0 AS Total_Orders, COUNT(*) AS Total_Rents
        FROM rent_order
        GROUP BY city
    ) AS city_distribution
    GROUP BY city
";

// Execute queries
$totalOrdersRentsPerMonthResult = $conn->query($totalOrdersRentsPerMonthSql);
$cityDistributionResult = $conn->query($cityDistributionSql);

// Fetch data
$totalOrdersRentsPerMonth = [];
while ($row = $totalOrdersRentsPerMonthResult->fetch_assoc()) {
    $totalOrdersRentsPerMonth[] = $row;
}

$cityDistribution = [];
while ($row = $cityDistributionResult->fetch_assoc()) {
    $cityDistribution[] = $row;
}

// Close connection
$conn->close();

// Prepare data to be sent as JSON
$data = [
    'totalOrdersRentsPerMonth' => $totalOrdersRentsPerMonth,
    'cityDistribution' => $cityDistribution,
];

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
