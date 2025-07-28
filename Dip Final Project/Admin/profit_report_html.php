<?php
// Start the session
session_start();

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

//$month = "06";

// Get month from URL parameter and validate it
$month = isset($_GET['month']) ? $_GET['month'] : '';
if (!preg_match('/^(0[1-9]|1[0-2])$/', $month)) {
    die("Invalid month");
}

// Function to fetch data from the database
function fetchData($sql, $conn) {
    $result = $conn->query($sql);
    $data = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Metrics Queries
$shopTableSql = "SELECT * FROM shop_order WHERE DATE_FORMAT(order_date, '%m') = '$month'";
$rentTableSql = "SELECT * FROM rent_order WHERE DATE_FORMAT(rent_date, '%m') = '$month'";

// Fetch Data
$shopTable = fetchData($shopTableSql, $conn);
$rentTable = fetchData($rentTableSql, $conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profit Report</title>
    <link rel="stylesheet" href="profit_report.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pass the PHP $month variable to JavaScript
        var month = "<?php echo $month; ?>";
    </script>
</head>
<body>
    <h1>Company Profit Report for Month <?php echo $month ?></h1>
    <div class="container">
    <div class="metric-section">
            <!-- Display Shop Order Table -->
            <h2>Monthly Order Details</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Product IDs</th>
                            <th>Total Price</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($shopTable as $row): ?>
                            <tr>
                                <td><?php echo $row['order_id']; ?></td>
                                <td><?php echo $row['customer_username']; ?></td>
                                <td><?php echo $row['product_ids']; ?></td>
                                <td><?php echo $row['total_price']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['order_date']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <!-- Display Rent Order Table -->
            <h2>Monthly Rental Details</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Product ID</th>
                            <th>Days</th>
                            <th>Price</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($rentTable as $row): ?>
                            <tr>
                                <td><?php echo $row['rent_id']; ?></td>
                                <td><?php echo $row['customer_username']; ?></td>
                                <td><?php echo $row['item_id']; ?></td>
                                <td><?php echo $row['rent_days']; ?></td>
                                <td><?php echo $row['rent_price']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['rent_date']; ?></td>
                                <td><?php echo $row['rent_status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
    <br>
        <!-- Metric 1: Total Sales Revenue -->
        <div class="metric">
            <h2>Total Sales Revenue</h2>
            <div class="table-view" id="salesRevenueTableView">
                <!-- Table view will be populated dynamically -->
            </div>
            <div class="graph-view">
                <canvas id="salesRevenueChart"></canvas>
            </div>
        </div>

        <!-- Metric 2: Total Rental Revenue -->
        <div class="metric">
            <h2>Total Rental Revenue</h2>
            <div class="table-view" id="rentalRevenueTableView">
                <!-- Table view will be populated dynamically -->
            </div>
            <div class="graph-view">
                <canvas id="rentalRevenueChart"></canvas>
            </div>
        </div>

        <!-- Metric 3: Total Profit -->
        <div class="metric">
            <h2>Total Profit</h2>
            <div class="table-view" id="totalProfitTableView">
                <!-- Table view will be populated dynamically -->
            </div>
            <div class="graph-view">
                <canvas id="totalProfitChart"></canvas>
            </div>
        </div>
    </div>

    <script src="profit_report.js"></script>
</body>
</html>
