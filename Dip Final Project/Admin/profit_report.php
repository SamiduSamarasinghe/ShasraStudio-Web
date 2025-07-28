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

// Get month from URL parameter and validate it
$month = isset($_GET['month']) ? $_GET['month'] : '';
$month = str_pad($month, 2, '0', STR_PAD_LEFT); // Ensure month is two digits

if (!preg_match('/^(0[1-9]|1[0-2])$/', $month)) {
    die("Invalid month");
}

// Metrics Queries
$totalSalesRevenueSql = "SELECT SUM(total_price) AS Total_Sales_Revenue FROM shop_order WHERE DATE_FORMAT(order_date, '%m') = '$month'";
$totalRentalRevenueSql = "SELECT SUM(rent_price) AS Total_Rental_Revenue FROM rent_order WHERE DATE_FORMAT(rent_date, '%m') = '$month'";
$totalProfitSql = "SELECT (COALESCE(SUM(total_price), 0) + COALESCE(SUM(rent_price), 0)) AS Total_Profit FROM shop_order LEFT JOIN rent_order ON DATE_FORMAT(shop_order.order_date, '%m') = '$month' AND DATE_FORMAT(rent_order.rent_date, '%m') = '$month'";

// Fetch Data
$totalSalesRevenueResult = $conn->query($totalSalesRevenueSql);
$totalRentalRevenueResult = $conn->query($totalRentalRevenueSql);
$totalProfitResult = $conn->query($totalProfitSql);

$totalSalesRevenue = $totalSalesRevenueResult->fetch_assoc()['Total_Sales_Revenue'];
$totalRentalRevenue = $totalRentalRevenueResult->fetch_assoc()['Total_Rental_Revenue'];
$totalProfit = $totalProfitResult->fetch_assoc()['Total_Profit'];

// Close connection
$conn->close();

// Prepare data to be sent as JSON
$data = [
    'totalSalesRevenue' => $totalSalesRevenue,
    'totalRentalRevenue' => $totalRentalRevenue,
    'totalProfit' => $totalProfit
];

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
