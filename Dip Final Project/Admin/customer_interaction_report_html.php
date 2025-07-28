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

// $fullName = $_GET['full_name'];
//$fullName = "Alice Johnson";
$fullName = isset($_GET['fullName']) ? $conn->real_escape_string($_GET['fullName']) : '';

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
$eventTableSql = "SELECT * FROM booking WHERE full_name='$fullName'"; 
$identityTableSql = "SELECT * FROM booking_identity WHERE full_name='$fullName'";
$outdoorTableSql = "SELECT * FROM booking_studio_outdoor WHERE full_name='$fullName'";
$weddingTableSql = "SELECT * FROM booking_wedding WHERE full_name='$fullName'";

// Fetch Data
$eventTable = fetchData($eventTableSql, $conn);
$identityTable = fetchData($identityTableSql, $conn);
$outdoorTable = fetchData($outdoorTableSql, $conn);
$weddingTable = fetchData($weddingTableSql, $conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Interaction Report</title>
    <link rel="stylesheet" href="customer_interaction_report.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var fullName = "<?php echo $fullName; ?>";
    </script>
</head>
<body>
    <div class="container">
        <h1>Customer Interaction Report</h1>
        
        <!-- Total Orders and Total Spend on Orders -->
        <div class="metric-section">
            <h2>Customer Order Details</h2>
            <div class="table-view">
                <table id="totalOrdersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product IDs</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <h2>Total Orders</h2>
            <div class="graph-view">
                <canvas id="totalOrdersChart"></canvas>
            </div>
            <h2>Total Spend on Orders</h2>
            <div class="graph-view">
                <canvas id="totalSpendOrdersChart"></canvas>
            </div>
        </div>
        
        <!-- Total Rental Transactions and Spend on Rentals -->
        <div class="metric-section">
            <h2>Customer Rental Transactions</h2>
            <div class="table-view">
                <table id="totalRentalsTable">
                    <thead>
                        <tr>
                            <th>Rent ID</th>
                            <th>Item ID</th>
                            <th>Rent Days</th>
                            <th>Rent Price</th>
                            <th>Rent Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <h2>Total Rental Transactions</h2>
            <div class="graph-view">
                <canvas id="totalRentalsChart"></canvas>
            </div>
            <h2>Total Spend on Rentals</h2>
            <div class="graph-view">
                <canvas id="totalSpendRentalsChart"></canvas>
            </div>
        </div>

        <!-- Display Booking Tables -->
        <div class="metric-section">
            <h2>Customer Booking Details</h2>
            <h3>Event Photography</h3>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event</th>
                            <th>Location</th>
                            <th>Date Time</th>
                            <th>Guests No</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($eventTable as $row): ?>
                            <tr>
                                <td><?php echo $row['booking_id']; ?></td>
                                <td><?php echo $row['event_type']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['event_datetime']; ?></td>
                                <td><?php echo $row['crowd_quantity']; ?></td>
                                <td><?php echo $row['event_description']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <h3>Identification Photography</h3>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Date Time</th>
                            <th>Cost</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($identityTable as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['photo_type']; ?></td>
                                <td><?php echo $row['photo_size']; ?></td>
                                <td><?php echo $row['photo_quantity']; ?></td>
                                <td><?php echo $row['booking_datetime']; ?></td>
                                <td><?php echo $row['total_cost']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <h3>Studio & Outdoor Photography</h3>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Date Time</th>
                            <th>Special Requirements</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($outdoorTable as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['request_type']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['booking_datetime']; ?></td>
                                <td><?php echo $row['special_requirements']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <h3>Wedding Photography</h3>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Location</th>
                            <th>Date Time</th>
                            <th>Guests No</th>
                            <th>Special Requirements</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($weddingTable as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['event_datetime']; ?></td>
                                <td><?php echo $row['crowd_quantity']; ?></td>
                                <td><?php echo $row['other_wantings']; ?></td>
                                <td><?php echo $row['event_description']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Booking Types -->
        <div class="metric-section">
            <h2>Booking Types Comparison</h2>
            <div class="graph-view">
                <canvas id="bookingTypesChart"></canvas>
            </div>
        </div>
    </div>
    <script src="customer_interaction_report.js"></script>
</body>
</html>
