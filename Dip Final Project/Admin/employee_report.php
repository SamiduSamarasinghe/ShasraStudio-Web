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

// Get employee name from URL
$employee_full_name = isset($_GET['employee']) ? $conn->real_escape_string($_GET['employee']) : '';

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
$attendanceTableSql = "SELECT Attendance_ID, Date, Time_In, Time_Out FROM employee_attendance WHERE Employee_Full_Name='$employee_full_name'";
$leaveTableSql = "SELECT Leave_ID, Date_From, Date_To, Duration, Reason, Status FROM employee_leaves WHERE Employee_Full_Name='$employee_full_name'";
$salaryTableSql = "SELECT * FROM employee_salary WHERE Employee_Full_Name='$employee_full_name'";
$taskTableSql = "SELECT * FROM employee_tasks WHERE Employee_Full_Name='$employee_full_name'";

$attendanceRateSql = "SELECT COUNT(*) AS Present_Days FROM employee_attendance WHERE Employee_Full_Name='$employee_full_name'";
$leaveBalanceSql = "SELECT COUNT(*) AS Leaves_Taken FROM employee_leaves WHERE Employee_Full_Name='$employee_full_name' AND Status='Approved'";
$punctualitySql = "SELECT SUM(CASE WHEN Time_In <= '09:00:00' THEN 1 ELSE 0 END) AS On_Time_Arrivals, SUM(CASE WHEN Time_In > '09:00:00' THEN 1 ELSE 0 END) AS Late_Arrivals FROM employee_attendance WHERE Employee_Full_Name='$employee_full_name'";
$totalWorkingHoursSql = "SELECT SUM(TIMESTAMPDIFF(HOUR, Time_In, Time_Out)) AS Total_Working_Hours FROM employee_attendance WHERE Employee_Full_Name='$employee_full_name'";
$workingHoursEachDaySql = "SELECT Date, TIMESTAMPDIFF(HOUR, Time_In, Time_Out) AS Working_Hours FROM employee_attendance WHERE Employee_Full_Name='$employee_full_name'";
$salaryDetailsSql = "SELECT SUM(Net_Salary) AS Total_Salary_Paid, SUM(Over_Time_Payment) AS Total_Overtime_Payment, SUM(Over_Time_Hours) AS Total_Overtime_Hours FROM employee_salary WHERE Employee_Full_Name='$employee_full_name'";
$taskCompletionRateSql = "SELECT SUM(CASE WHEN Status='Completed' THEN 1 ELSE 0 END) AS Tasks_Completed, SUM(CASE WHEN Status='Pending' THEN 1 ELSE 0 END) AS Tasks_Pending FROM employee_tasks WHERE Employee_Full_Name='$employee_full_name'";

// Fetch Data
$attendanceTable = fetchData($attendanceTableSql, $conn);
$leaveTable = fetchData($leaveTableSql, $conn);
$salaryTable = fetchData($salaryTableSql, $conn);
$taskTable = fetchData($taskTableSql, $conn);

$attendanceRate = fetchData($attendanceRateSql, $conn);
$leaveBalance = fetchData($leaveBalanceSql, $conn);
$punctuality = fetchData($punctualitySql, $conn);
$totalWorkingHours = fetchData($totalWorkingHoursSql, $conn);
$workingHoursEachDay = fetchData($workingHoursEachDaySql, $conn);
$salaryDetails = fetchData($salaryDetailsSql, $conn);
$taskCompletionRate = fetchData($taskCompletionRateSql, $conn);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Performance Report</title>
    <link rel="stylesheet" href="report_styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<h1>Employee Performance Report for <?php echo $employee_full_name; ?></h1>
    <div class="container">
        <!-- Display Attendance Table -->
        <div class="metric">
            <h2>Employee Attendance</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($attendanceTable as $row): ?>
                            <tr>
                                <td><?php echo $row['Attendance_ID']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['Time_In']; ?></td>
                                <td><?php echo $row['Time_Out']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Display Leaves Table -->
        <div class="metric">
            <h2>Employee Leaves</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th>Duration</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($leaveTable as $row): ?>
                            <tr>
                                <td><?php echo $row['Leave_ID']; ?></td>
                                <td><?php echo $row['Date_From']; ?></td>
                                <td><?php echo $row['Date_To']; ?></td>
                                <td><?php echo $row['Duration']; ?></td>
                                <td><?php echo $row['Reason']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Attendance Rate -->
        <div class="metric">
            <h2>Attendance Rate</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>Present Days</th>
                            <th>Leaves Taken</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $attendanceRate[0]['Present_Days']; ?></td>
                            <td><?php echo $leaveBalance[0]['Leaves_Taken']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="graph-view">
                <canvas id="attendanceRateChart"></canvas>
            </div>
        </div>

        <!-- Punctuality -->
        <div class="metric">
            <h2>Punctuality</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>On Time Arrivals</th>
                            <th>Late Arrivals</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $punctuality[0]['On_Time_Arrivals']; ?></td>
                            <td><?php echo $punctuality[0]['Late_Arrivals']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="graph-view">
                <canvas id="punctualityChart"></canvas>
            </div>
        </div>

        <!-- Total Working Hours -->
        <div class="metric">
            <h2>Total Working Hours</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Working Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($workingHoursEachDay as $row): ?>
                            <tr>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['Working_Hours']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><?php echo $totalWorkingHours[0]['Total_Working_Hours']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="graph-view">
                <canvas id="totalWorkingHoursChart"></canvas>
            </div>
        </div>

        <!-- Display Salary Table -->
        <div class="metric">
            <h2>Employee Salary Details</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Occupation</th>
                            <th>Basic Salary</th>
                            <th>Over Time Hours</th>
                            <th>Overtime Payment</th>
                            <th>Net Salary</th>
                            <th>Status</th>
                            <th>Paid Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($salaryTable as $row): ?>
                            <tr>
                                <td><?php echo $row['Salary_ID']; ?></td>
                                <td><?php echo $row['Employee_Occupation']; ?></td>
                                <td><?php echo $row['Basic_Salary']; ?></td>
                                <td><?php echo $row['Over_Time_Hours']; ?></td>
                                <td><?php echo $row['Over_Time_Payment']; ?></td>
                                <td><?php echo $row['Net_Salary']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                                <td><?php echo $row['Salary_Paid_Date']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Salary Details -->
        <div class="metric">
            <!-- <h2>Salary Details</h2> -->
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>Total Salary Paid</th>
                            <th>Total Overtime Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo 'Rs. '. $salaryDetails[0]['Total_Salary_Paid']; ?></td>
                            <td><?php echo 'Rs. '. $salaryDetails[0]['Total_Overtime_Payment']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="graph-view">
                <canvas id="salaryDetailsChart"></canvas>
            </div>
        </div>

        <!-- Total Overtime Hours -->
        <div class="metric">
            <h2>Total Overtime Hours</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>Total Overtime Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $salaryDetails[0]['Total_Overtime_Hours']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="graph-view">
                <canvas id="totalOvertimeHoursChart"></canvas>
            </div>
        </div>

        <!-- Display Task Table -->
        <div class="metric">
            <h2>Employee Task Details</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($taskTable as $row): ?>
                            <tr>
                                <td><?php echo $row['Task_ID']; ?></td>
                                <td><?php echo $row['Task_Subject']; ?></td>
                                <td><?php echo $row['Task_Description']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Task Completion Rate -->
        <div class="metric">
            <h2>Task Completion Rate</h2>
            <div class="table-view">
                <table>
                    <thead>
                        <tr>
                            <th>Tasks Completed</th>
                            <th>Tasks Pending</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $taskCompletionRate[0]['Tasks_Completed']; ?></td>
                            <td><?php echo $taskCompletionRate[0]['Tasks_Pending']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="graph-view">
                <canvas id="taskCompletionRateChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        const attendanceRateData = <?php echo json_encode($attendanceRate); ?>;
        const leaveBalanceData = <?php echo json_encode($leaveBalance); ?>;
        const punctualityData = <?php echo json_encode($punctuality); ?>;
        const totalWorkingHoursData = <?php echo json_encode($totalWorkingHours); ?>;
        const workingHoursEachDayData = <?php echo json_encode($workingHoursEachDay); ?>;
        const salaryDetailsData = <?php echo json_encode($salaryDetails); ?>;
        const taskCompletionRateData = <?php echo json_encode($taskCompletionRate); ?>;

        // Attendance Rate Chart
        const attendanceRateCtx = document.getElementById('attendanceRateChart').getContext('2d');
        new Chart(attendanceRateCtx, {
            type: 'bar',
            data: {
                labels: ['Present Days', 'Leaves Taken'],
                datasets: [{
                    label: 'Attendance Rate',
                    data: [attendanceRateData[0]['Present_Days'], leaveBalanceData[0]['Leaves_Taken']],
                    backgroundColor: ['#4caf50', '#f44336']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Punctuality Chart
        const punctualityCtx = document.getElementById('punctualityChart').getContext('2d');
        new Chart(punctualityCtx, {
            type: 'pie',
            data: {
                labels: ['On Time Arrivals', 'Late Arrivals'],
                datasets: [{
                    data: [punctualityData[0]['On_Time_Arrivals'], punctualityData[0]['Late_Arrivals']],
                    backgroundColor: ['#4caf50', '#f44336']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Total Working Hours Chart
        const totalWorkingHoursCtx = document.getElementById('totalWorkingHoursChart').getContext('2d');
        new Chart(totalWorkingHoursCtx, {
            type: 'line',
            data: {
                labels: workingHoursEachDayData.map(row => row.Date),
                datasets: [{
                    label: 'Working Hours',
                    data: workingHoursEachDayData.map(row => row.Working_Hours),
                    backgroundColor: '#2196f3',
                    borderColor: '#2196f3',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Salary Details Chart
        const salaryDetailsCtx = document.getElementById('salaryDetailsChart').getContext('2d');
        new Chart(salaryDetailsCtx, {
            type: 'bar',
            data: {
                labels: ['Total Salary Paid', 'Total Overtime Payment'],
                datasets: [{
                    label: 'Salary Details',
                    data: [salaryDetailsData[0]['Total_Salary_Paid'], salaryDetailsData[0]['Total_Overtime_Payment']],
                    backgroundColor: ['#4caf50', '#ff9800']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Total Overtime Hours Chart
        const totalOvertimeHoursCtx = document.getElementById('totalOvertimeHoursChart').getContext('2d');
        new Chart(totalOvertimeHoursCtx, {
            type: 'bar',
            data: {
                labels: ['Total Overtime Hours'],
                datasets: [{
                    label: 'Total Overtime Hours',
                    data: [salaryDetailsData[0]['Total_Overtime_Hours']],
                    backgroundColor: '#ff9800'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Task Completion Rate Chart
        const taskCompletionRateCtx = document.getElementById('taskCompletionRateChart').getContext('2d');
        new Chart(taskCompletionRateCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tasks Completed', 'Tasks Pending'],
                datasets: [{
                    data: [taskCompletionRateData[0]['Tasks_Completed'], taskCompletionRateData[0]['Tasks_Pending']],
                    backgroundColor: ['#4caf50', '#f44336']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
