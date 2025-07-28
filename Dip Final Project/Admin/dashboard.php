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
// $employee_full_name = $_GET['employee'];
//$employee_full_name = "Emily Davis";

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
$empTableSql = "SELECT * FROM employeelog";
$customerTableSql = "SELECT * FROM customer";

$eventTableSql = "SELECT * FROM booking WHERE status='Completed'"; 
$identityTableSql = "SELECT * FROM booking_identity WHERE status='Completed'";
$outdoorTableSql = "SELECT * FROM booking_studio_outdoor WHERE status='Completed'";
$weddingTableSql = "SELECT * FROM booking_wedding WHERE status='Completed'";

$shopTableSql = "SELECT * FROM shop_order WHERE status='Completed'"; 
$rentTableSql = "SELECT * FROM rent_order WHERE rent_status='Completed'"; 


// Fetch Data
$empTable = fetchData($empTableSql, $conn);
$customerTable = fetchData($customerTableSql, $conn);

$eventTable = fetchData($eventTableSql, $conn);
$identityTable = fetchData($identityTableSql, $conn);
$outdoorTable = fetchData($outdoorTableSql, $conn);
$weddingTable = fetchData($weddingTableSql, $conn);

$shopTable = fetchData($shopTableSql, $conn);
$rentTable = fetchData($rentTableSql, $conn);


$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Fontawesome CDN Link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav class="sidebar">
      <a href="#" class="logo">Sahasra Studio</a>
      <div class="menu-content">
        <ul class="menu-items">
          <div class="menu-title"><a href="dashboard.php"> Manager Dashboard</a></div>
          <li class="item">
            <div class="submenu-item">
              <span>Finance</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Employee
              </div>
              <li class="item"><a href="#check-profit">Check Profit</a></li>
              <li class="item">
                <a href="#pay-salaries-history">Pay Salaries history</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>Employee</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Employee
              </div>
              <li class="item"><a href="#Employee-Leaves">Manage Leaves</a></li>
              <li class="item">
                <a href="#pay-salaries-container">Pay Salaries</a>
              </li>
              <li class="item">
                <a href="#check-employee-overtime">Check Employee Overtime</a>
              </li>
              <li class="item">
                <a href="#register-employee">Register Employee</a>
              </li>
              <li class="item">
                <a href="#delete-employee">Delete Employee</a>
              </li>

              <li class="item">
                <a href="#checkEmployeePerformanceStatus"
                  >Check Employee Performance Status</a
                >
              </li>
              <li class="item">
                <a href="#send-messages">Send Messages to Employee</a>
              </li>
              <li class="item">
                <a href="#leave-history">Check Employee Leave History</a>
              </li>
              <li class="item">
                <a href="#view-employee-profile">View Employee Profile</a>
              </li>
              <li class="item">
                <a href="#assign-task-to-employee">Assign Task To Employee</a>
              </li>
              <li class="item">
                <a href="#check-attendace">Check Attendance</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>Order</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Order
              </div>
              <li class="item"><a href="#order-history">Order History</a></li>
              <li class="item">
                <a href="#new-orders">New Orders</a>
              </li>
              <li class="item">
                <a href="#update-order-status">Update Order Status</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>Bookings</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Booking
              </div>
              <li class="item">
                <a href="#new-bookings">New Bookings</a>
              </li>
              <li class="item">
                <a href="#booking-history">Booking History</a>
              </li>
              <li class="item">
                <a href="#ongoing-bookings">Ongoing Bookings</a>
              </li>
              <li class="item">
                <a href="#reply-to-booking">Reply To Booking</a>
              </li>
              <li class="item">
                <a href="#update-booking-status">Update Booking Status</a>
              </li>
            </ul>
          </li>
          <li class="item">
            <div class="submenu-item">
              <span>Inquiries</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Inquiries
              </div>
              <li class="item">
                <a href="#check-inquiries">Check Inquiries</a>
              </li>
              <li class="item">
                <a href="#view-inquries-history">View Inquries History</a>
              </li>
            </ul>
          </li>

          <li class="item">
            <div class="submenu-item">
              <span>Customer</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Customer
              </div>
              <li class="item">
                <a href="#view-customer">View Customer</a>
              </li>
              <li class="item">
                <a href="#customer-order-history"
                  >Check Customer Order History</a
                >
              </li>
              <li class="item">
                <a href="#customer-booking-history"
                  >Check Customer Booking History</a
                >
              </li>
            </ul>
          </li>

          <li class="item">
            <div class="submenu-item">
              <span>Inventory</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Inventory
              </div>
              <li class="item">
                <a href="#add-item">Add Item</a>
              </li>
              <li class="item">
                <a href="#delete-item">Delete Item</a>
              </li>
              <li class="item">
                <a href="#check-item-quantity">Check Quantity</a>
              </li>
            </ul>
          </li>

          <li class="item">
            <div class="submenu-item">
              <span>Renting</span>
              <i class="fa-solid fa-chevron-right"></i>
            </div>
            <ul class="menu-items submenu">
              <div class="menu-title">
                <i class="fa-solid fa-chevron-left"></i>
                Renting
              </div>
              <li class="item">
                <a href="#update-renting-resources">Add Renting Resources</a>
              </li>
              <li class="item">
                <a href="#delete-renting-resources">Delete Renting Resources</a>
              </li>
              <li class="item">
                <a href="#renting-history">Renting History</a>
              </li>
              <li class="item">
                <a href="#check-renting">Check Rentings</a>
              </li>
            </ul>
          </li>

          <li class="item"><a href="#check-reviews">Check Reviews</a></li>
          <li class="item">
            <a href="#notify-discounts">Notify Discounts And Promotions</a>
          </li>
         
          <li id="logout">
            <a href="#">Log Out</a>
          </li>

        </ul>
      </div>
    </nav>

    <nav class="navbar">
      <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

    <main class="main">
      <div class="dashboard">
        <div class="summary-cards">
          <div class="card">2478<br />New Orders</div>
          <div class="card">983<br />New Bookings</div>
          <div class="card">1256<br />New Inquiries</div>
          <div class="card">652<br />Total Orders</div>
        </div>
        <div class="account-overview-activity">
          <div class="account-overview">
            <h3>Account Overview</h3>
            <div class="chart"></div>
          </div>
          <div class="activity">
            <h3>Activity</h3>
            <div class="graph"></div>
          </div>
        </div>
        <div class="salary-spending">
          <div class="transfer-salaries">
            <h3>Transfer Salaries</h3>
            <div class="details">
              <p>Manager<br />Your Balance: RS 24,571.93</p>
              <input type="text" placeholder="Insert Amount" />
              <button>TRANSFER NOW</button>
            </div>
          </div>
          <div class="spending">
            <h3>Spending</h3>
            <ul>
              <li>Investment: RS 1415 / RS 2000</li>
              <li>Salaries: RS 1567 / RS 5000</li>
              <li>Order Cost: RS 470 / RS 10000</li>
              <li>Renting: RS 3890 / RS 4000</li>
            </ul>
          </div>
        </div>
        <div class="transaction-overview">
          <h3>Transaction Overview</h3>
          <div class="graph"></div>
          <button>Download Report</button>
        </div>
      </div>
      <div id="finance-content" class="content">
        <h2>Finance Details</h2>
        <p>This is where finance details will be displayed.</p>
      </div>

      <!-- Leaves -->
      <div id="Employee-Leaves" class="content table-container">
        <h2 class="mH2">Manage Leaves</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Designation</th>
              <th>Date</th>
              <th>Days</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>editor</td>
              <td>2023-06-01</td>
              <td><span class="status pending">3</span></td>
              <td>
                <select value="Action">
                  <option value="action" selected disabled hidden>
                    Action
                  </option>
                  <option value="approve">Approve</option>
                  <option value="deny">Deny</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Salary -->
      <div id="pay-salaries-container" class="content table-container">
        <h2 class="mH2">Pay Salaries</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Designation</th>
              <th>Basic Salary</th>
              <th>Over Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>editor</td>
              <td>50000</td>
              <td>5000</td>
              <td><button class="paybutton1">Pay</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------register-employee-------------------------------->
      <div id="register-employee" class="content">
        <!-- <header>Registration</header> -->

        <br />
        <form action="#">
          <div class="form first">
            <div class="forminner">
              <div class="details personal">
                <h2 class="mH2">Register Employee</h2>
                <br />
                <span class="title">Personal Details</span>

                <div class="fields">
                  <div class="input-field">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter your name" required />
                  </div>

                  <div class="input-field">
                    <label>Address</label>
                    <input type="text" placeholder="Enter address" required />
                  </div>

                  <div class="input-field">
                    <label>Email</label>
                    <input
                      type="text"
                      placeholder="Enter your email"
                      required
                    />
                  </div>

                  <div class="input-field">
                    <label>Mobile Number</label>
                    <input
                      type="number"
                      placeholder="Enter mobile number"
                      required
                    />
                  </div>

                  <div class="input-field">
                    <label>Gender</label>
                    <select required>
                      <option disabled selected>Select gender</option>
                      <option>Male</option>
                      <option>Female</option>
                      <option>Others</option>
                    </select>
                  </div>

                  <div class="input-field">
                    <label>Occupation</label>
                    <input
                      type="text"
                      placeholder="Enter your ccupation"
                      required
                    />
                  </div>
                </div>
              </div>

              <div class="details ID">
                <span class="title">Identity Details</span>

                <div class="fields">
                  <div class="input-field">
                    <label>ID Number</label>
                    <input
                      type="number"
                      placeholder="Enter ID number"
                      required
                    />
                  </div>
                  <div class="input-field">
                    <label>password</label>
                    <input type="password" required />
                  </div>
                </div>

                <button id="registerBtn" class="nextBtn">
                  <span class="btnText">Register</span>
                  <i class="uil uil-navigator"></i>
                </button>
              </div>
            </div>
          </div>
        </form>
        <!-- <-------------------------------register-employee end-------------------------------->
      </div>
      <!-- <-------------------------------delete employee-------------------------------->
      <div class="inner-Message">
        <div id="delete-employee" class="content table-container">
          <h2 class="mH2">Delete Employee</h2>
          <br />
          <table class="application-list">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>User Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Kavindu</td>
                <td>editor</td>
                <td>Kavi1</td>
                <td>
                  <button class="show-modal">Delete</button>
                  <span class="overlay"></span>
                </td>

                <section>
                  <div class="modal-box">
                    <i class="fa-regular fa-circle-check"></i>
                    <h2></h2>
                    <h3>Are you sure you want to delete this employee ?</h3>
                    <div class="buttons">
                      <button class="close-btn">Confirm</button>
                      <button class="can-btn">Cancel</button>
                    </div>
                  </div>
                </section>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- <-------------------------------delete employee end-------------------------------->

      <!-- <-------------------------------check employee performance status-------------------------------->
      <div id="checkEmployeePerformanceStatus" class="content table-container">
        <h2 class="mH2">Check Employee Performance Status</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>Employee Name</th>
              <th>Occupation</th>
              <th>ID No</th>
              <th>Check Performance</th>
            </tr>
          </thead>
          <tbody>
                    <?php foreach ($empTable as $row): ?>
                            <tr>
                                <td><?php echo $row['Full_Name']; ?></td>
                                <td><?php echo $row['Occupation']; ?></td>
                                <td><?php echo $row['ID_Number']; ?></td>
                                <td>
                                  <a href="employee_report.php?employee=<?php echo urlencode($row['Full_Name']); ?>">
                                    <button class="reprotbutton1">Check Employee Performance</button>
                                  </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
        </table>
      </div>

      <!-- <-------------------------------check employee performance status end-------------------------------->
      <!-- <-------------------------------send messages to employee start-------------------------------->
      <div id="send-messages" class="content">
        <div class="wrapper">
          <header>Send Messages To Employee</header>
          <form action="#">
            <div class="dbl-field">
              <div class="input-field">
                <label>To</label>
                <select required>
                  <option disabled selected>Select reciver</option>
                  <option>All</option>
                  <option>Kavindu</option>
                  <option>Nuwan</option>
                  <option>Avin</option>
                </select>
                <br />
                <label>Subject</label>
                <input type="text" name="subject" placeholder="Enter subject" />
              </div>
            </div>

            <div class="message">
              <textarea
                placeholder="Write your message"
                name="message"
              ></textarea>
            </div>
            <div class="button-area">
              <button type="submit">Send Message</button>
              <span></span>
            </div>
          </form>
        </div>
      </div>
      <!-- <-------------------------------send messages to employee end-------------------------------->
      <!-- <-------------------------------check employee leave history start-------------------------------->
      <div id="leave-history" class="content table-container">
        <div class="leave_hitory">
          <h2>Check Employee Leave History</h2>
          <br />
          <label class="emhistory"><b>Choose Employee</b></label>
          <select required>
            <option disabled selected>Select reciver</option>
            <option>All</option>
            <option>Kavindu</option>
            <option>Nuwan</option>
            <option>Avin</option>
          </select>
        </div>

        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Designation</th>
              <th>Date</th>
              <th>Days</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>Editor</td>
              <td>2022-12-1</td>
              <td>5</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------view employee profile staart-------------------------------->
      <div id="view-employee-profile" class="content table-container">
        <h2 class="mH2">View Employee Profile</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Designation</th>
              <th>User Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>editor</td>
              <td>kavi1</td>
              <td><a href="./EmployeeProfile.html" target="_blank"><button class="view-button">View Profile</button></a></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------view employee profile end-------------------------------->
      <!-- <-------------------------------Assign taks to employee start-------------------------------->
      <div id="assign-task-to-employee" class="content">
        <div class="wrapper">
          <header>Assign Task To Employee</header>
          <form action="#">
            <div class="dbl-field">
              <div class="input-field">
                <label>Select Employee</label>
                <select required>
                  <option disabled selected>Select Employee</option>
                  <option>All</option>
                  <option>Kavindu</option>
                  <option>Nuwan</option>
                  <option>Avin</option>
                </select>
                <br />
                <label>Task</label>
                <input type="text" name="subject" placeholder="Enter subject" />
              </div>
            </div>

            <div class="message">
              <textarea
                placeholder="Write your description here"
                name="Task"
              ></textarea>
            </div>
            <div class="button-area">
              <button type="submit">Assign</button>
              <span></span>
            </div>
          </form>
        </div>
      </div>
      <!-- <-------------------------------Assign taks to employee end-------------------------------->

      <!-- <-------------------------------check employee overtime -------------------------------->
      <div id="check-employee-overtime" class="content table-container">
        <div class="leave_hitory">
          <h2>Check Employee Overtime</h2>
          <br />
          <label class="emhistory"><b>Choose Employee</b></label>
          <select required>
            <option disabled selected>Select reciver</option>
            <option>Kavindu</option>
            <option>Nuwan</option>
            <option>Avin</option>
          </select>
        </div>

        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Designation</th>
              <th>hours</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>Editor</td>
              <td>20</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------check employee overtime end -------------------------------->
      <!-- <-------------------------------check employee attendance start -------------------------------->
      <div id="check-attendace" class="content table-container">
        <h2 class="mH2">Check Attendance</h2>
        <br />
        <label class="emhistory"><b>Choose Employee</b></label>
        <select required>
          <option disabled selected>Select Employee</option>
          <option>Kavindu</option>
          <option>Nuwan</option>
          <option>Avin</option>
          <option>Ranil</option>
        </select>

        <table class="application-list">
          <br />
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Date</th>
              <th>Time in</th>
              <th>Time out</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Ranil</td>
              <td>01/06/2024</td>
              <td>8.30 am</td>
              <td>5.30 pm</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Ranil</td>
              <td>01/06/2024</td>
              <td>8.30 am</td>
              <td>5.30 pm</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Ranil</td>
              <td>01/06/2024</td>
              <td>8.30 am</td>
              <td>5.30 pm</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Ranil</td>
              <td>01/06/2024</td>
              <td>8.30 am</td>
              <td>5.30 pm</td>
            </tr>
            <tr>
              <td>1</td>
              <td>Ranil</td>
              <td>01/06/2024</td>
              <td>8.30 am</td>
              <td>5.30 pm</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------check employee attendance end -------------------------------->
      

      
      <!-- <-------------------------------Finance Start -------------------------------->
      <!-- <-------------------------------check profit Start -------------------------------->
      <div id="check-profit" class="content table-container">
        <h2>Check Profit</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>ID</th>
              <th>Month</th>
              <th>Monthly Profit</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>01</td>
              <td>January</td>
              <td>
                  <a href="profit_report_html.php?month=01">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a>
              </td>
            </tr>
            <tr>
              <td>02</td>
              <td>February</td>
              <td>
                  <a href="profit_report_html.php?month=02">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a>
              </td>
            </tr>
            <tr>
              <td>03</td>
              <td>March</td>
              <td>
              <a href="profit_report_html.php?month=03">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a>
              </td>
            </tr>
            <tr>
              <td>04</td>
              <td>April</td>
              <td><a href="profit_report_html.php?month=04">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>05</td>
              <td>May</td>
              <td><a href="profit_report_html.php?month=05">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>06</td>
              <td>June</td>
              <td><a href="profit_report_html.php?month=06">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>07</td>
              <td>July</td>
              <td><a href="profit_report_html.php?month=07">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>08</td>
              <td>August</td>
              <td><a href="profit_report_html.php?month=08">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>09</td>
              <td>September</td>
              <td><a href="profit_report_html.php?month=09">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>10</td>
              <td>October</td>
              <td><a href="profit_report_html.php?month=10">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>11</td>
              <td>November</td>
              <td><a href="profit_report_html.php?month=11">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
            <tr>
              <td>12</td>
              <td>December</td>
              <td><a href="profit_report_html.php?month=12">
                    <button class="reprotbutton1">Check Monthly Profit</button>
                  </a></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------check profit end -------------------------------->


      <!-- <-------------------------------pay salary history start -------------------------------->
      <div id="pay-salaries-history" class="content table-container">
        <h2>Pay Salaries History</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Designation</th>
              <th>User Name</th>
              <th>Date</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>editor</td>
              <td>kv1</td>
              <td>2022-12-06</td>
              <td>5000</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------pay salary history end -------------------------------->

      <!-- <-------------------------------Finance end -------------------------------->
      <!-- <-------------------------------Order start -------------------------------->
      <!-- <-------------------------------Order history start -------------------------------->
      <div id="order-history" class="content table-container">
        <h2>Order History</h2>
        <br />
        <div>
        <a href="orders_rents_report.html">
          <button class="clearbtn">Generate Insights Report</button>
          </a>
          <span class="overlay"></span>
        </div>
        <br>
        <table class="application-list">
        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Product IDs</th>
                            <th>Total Price</th>
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
                                <td><?php echo $row['order_date']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
        </table>
      </div>
      <!-- <-------------------------------Order history end -------------------------------->
      <!-- <-------------------------------New Orders start -------------------------------->
      <div id="new-orders" class="content table-container">
        <h2>New Orders</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Order Number</th>
              <th>Customer ID</th>
              <th>Item</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2023-06-01</td>
              <td>123</td>
              <td>kv1</td>
              <td>Nikon Camera</td>
              <td>Nikon Z 5</td>
              <td>5000</td>
              <td>Processing</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------New Orders end -------------------------------->
      <!-- <-------------------------------udpate status of Orders start -------------------------------->
      <div id="update-order-status" class="content table-container">
        <h2>Update Status Of Orders</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Order Number</th>
              <th>Customer ID</th>
              <th>Item</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Current Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2023-06-01</td>
              <td>123</td>
              <td>kv1</td>
              <td>Nikon Camera</td>
              <td>Nikon Z 5</td>
              <td>5000</td>
              <td>Processing</td>
              <td>
                <select value="Action">
                  <option value="action" selected disabled hidden>
                    Status
                  </option>
                  <option value="Processing">Processing</option>
                  <option value="Completed">Completed</option>
                  <option value="Delevery">Delevery</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------update status of  Orders end -------------------------------->
      <!-- <-------------------------------Order end -------------------------------->

      <!-- <-------------------------------Booking start -------------------------------->
      <!-- <-------------------------------Accept/Deny booking start -------------------------------->
      <div id="new-bookings" class="content table-container">
        <h2 class="mH2">New Bookings</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Booking Number</th>
              <th>Customer ID</th>
              <th>Date</th>
              <th>Event</th>
              <th>Description</th>
              <th>Cost</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>123</td>
              <td>kavi1</td>
              <td>2023-06-01</td>
              <td>Birthday Party</td>
              <td>Kavi's birthday party</td>
              <td>5000</td>

              <td>
                <select value="Action">
                  <option value="action" selected disabled hidden>
                    Action
                  </option>
                  <option value="approve">Accept</option>
                  <option value="deny">Deny</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------Accept/Deny booking end -------------------------------->

      <!-- <-------------------------------Booking History Start -------------------------------->
      <div id="booking-history" class="content table-container">
        <h2>Booking History</h2>
        <br />
        <div>
        <a href="bookings_report.html">
          <button class="clearbtn">Generate Insights Report</button>
          </a>
          <span class="overlay"></span>
        </div>
        <br>

        <h3>Event Photography</h3>
        <table class="application-list">
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
        <br>
        <h3>Identification Photography</h3>
                <table class="application-list">
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
                <br>
                <h3>Studio & Outdoor Photography</h3>
                <table class="application-list">
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
                <br>
                <h3>Wedding Photography</h3>
                <table class="application-list">
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
      <!-- <-------------------------------Booking History end -------------------------------->
      <!-- <-------------------------------New Booking Start -------------------------------->
      <div id="ongoing-bookings" class="content table-container">
        <h2>Ongoing Bookings</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Booking Number</th>
              <th>Customer ID</th>
              <th>Event</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2023-06-01</td>
              <td>123</td>
              <td>kv1</td>
              <td>Brithday</td>
              <td>Kavi's birthday party</td>
              <td>5000</td>
              <td>Ongoing</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------New Booking end -------------------------------->
      <!-- <-------------------------------Reply to  Booking Start -------------------------------->
      <div id="reply-to-booking" class="content">
        <div class="wrapper">
          <header>Reply To Bookings</header>
          <form action="#">
            <div class="dbl-field">
              <div class="input-field">
                <label>Booking ID</label>
                <select required>
                  <option disabled selected>Select reciver</option>
                  <option>126</option>
                  <option>23</option>
                  <option>453</option>
                  <option>123</option>
                </select>
                <br />
                <label>Subject</label>
                <input type="text" name="subject" placeholder="Enter subject" />
              </div>
            </div>

            <div class="message">
              <textarea
                placeholder="Write your message"
                name="message"
              ></textarea>
            </div>
            <div class="button-area">
              <button type="submit">Send Message</button>
              <span></span>
            </div>
          </form>
        </div>
      </div>
      <!-- <-------------------------------Reply to  Booking end -------------------------------->
      <!-- <-------------------------------Update Booking status start -------------------------------->
      <div id="update-booking-status" class="content table-container">
        <h2>Update Status Of Bookings</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Booking Number</th>
              <th>Customer ID</th>
              <th>Event</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Current Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2023-06-01</td>
              <td>123</td>
              <td>kv1</td>
              <td>party</td>
              <td>brithday party</td>
              <td>5000</td>
              <td>Ongoing</td>
              <td>
                <select value="Action">
                  <option value="action" selected disabled hidden>
                    Status
                  </option>
                  <option value="Ongoing">Ongoing</option>
                  <option value="Completed">Completed</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------update Booking status end -------------------------------->
      <!-- <-------------------------------Booking end -------------------------------->


      <!-- <-------------------------------Customer Start -------------------------------->
      <!-- <-------------------------------Customer view profile start -------------------------------->
      <div id="view-customer" class="content table-container">
        <h2 class="mH2">View Customer Profile</h2>
        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>Customer Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Profile</th>
              <th>Generate</th>
            </tr>
          </thead>
          <tbody>
                    <?php foreach ($customerTable as $row): ?>
                            <tr>
                                <td><?php echo $row['Full_Name']; ?></td>
                                <td><?php echo $row['Username']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><a href="CustomerProfile.html" target="_blank"><button class="reprotbutton1">View</button></a></td>
                                <td>
                                  <a href="customer_interaction_report_html.php?fullName=<?php echo urlencode($row['Full_Name']); ?>">
                                    <button class="reprotbutton1">Check Report</button>
                                  </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
        </table>
      </div>
      <!-- <-------------------------------Customer view profile end -------------------------------->
      <!-- <-------------------------------Customer Order History start -------------------------------->
      <div id="customer-order-history" class="content table-container">
        <div class="leave_hitory">
          <h2>Order History</h2>
          <br />

          <label class="emhistory"><b>Choose Customer</b></label>
          <select required>
            <option disabled selected>Select ID</option>
            <option>Kavi1</option>
            <option>nu1</option>
            <option>avi1</option>
          </select>
        </div>

        <br />
        <div>
          <button class="clearbtn">clear history</button>
          <span class="overlay"></span>
        </div>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Order Number</th>
              <th>Customer ID</th>
              <th>Item</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2023-06-01</td>
              <td>123</td>
              <td>kv1</td>
              <td>Nikon Camera</td>
              <td>Nikon Z 5</td>
              <td>5000</td>
              <td>Completed</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------Customer Order History end -------------------------------->
      <!-- <-------------------------------Customer Booking History start -------------------------------->
      <div id="customer-booking-history" class="content table-container">
        <div class="leave_hitory">
          <h2>Booking History</h2>
          <br />
          <label class="emhistory"><b>Choose Customer</b></label>
          <select required>
            <option disabled selected>Select ID</option>
            <option>Kavi1</option>
            <option>nu1</option>
            <option>avi1</option>
          </select>
        </div>

        <div>
          <button class="clearbtn">clear history</button>
          <span class="overlay"></span>
        </div>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Booking Number</th>
              <th>Customer ID</th>
              <th>Event</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2023-06-01</td>
              <td>123</td>
              <td>kv1</td>
              <td>Brithday</td>
              <td>Kavi's birthday party</td>
              <td>5000</td>
              <td>Completed</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------Customer Booking History end -------------------------------->
      <!-- <-------------------------------Inquries check and replay start -------------------------------->
      <div id="check-reviews" class="content table-container">
        <h2>Check Reviewss</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Customer ID</th>
              <th>Review ID</th>
              <th>Content</th>
              <th>Date</th>
              <th>Contact Number</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavi1</td>
              <td>r1</td>
              <td>highly recommended</td>
              <td>2021-12-12</td>
              <td>0719933500</td>
              <td>
                <section>
                  <div>
                    <div id="hireBtn" class="button">
                      <a href="./message.html" target="_blank"><button class="view-button">Reply</button></a>
                    </div>
                  </div>
                  <!-- popup box start -->
                  <div class="popup-outer">
                    <div class="popup-box">
                      <i id="close" class="bx bx-x close"></i>
                      <form action="#">
                        <textarea
                          spellcheck="false"
                          placeholder="Enter your message"
                        ></textarea>
                        <div class="button">
                          <button id="close" class="cancel">Cancel</button>
                          <button class="send">Send</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------Inquries check and replay end  -------------------------------->
      <!-- <-------------------------------Customer end -------------------------------->
      <!-- <-------------------------------Inquries Start -------------------------------->
      <!-- <-------------------------------Inquries check and replay start -------------------------------->
      <div id="check-inquiries" class="content table-container">
        <h2>Check Inquiries</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Contact Number</th>
              <th>Inquriy</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>Nimshan</td>
              <td>malabe,colombo</td>
              <td>kavindu1@gmail.com</td>
              <td>0719933500</td>
              <td>I want to change my camera</td>
              <td>
                <a href="./message.html" target="_blank"><button class="view-button">Reply</button></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------Inquries check and replay end  -------------------------------->
      <!-- <-------------------------------Inquries history start  -------------------------------->
      <div id="view-inquries-history" class="content table-container">
        <h2>Check Inquiries History</h2>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Address</th>
              <th>Email</th>
              <th>Contact Number</th>
              <th>Inquriy</th>
              <th>Reply</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavindu</td>
              <td>Nimshan</td>
              <td>malabe,colombo</td>
              <td>kavindu1@gmail.com</td>
              <td>0719933500</td>
              <td>I want to change my camera</td>
              <td>Sure</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------Inquries history end  -------------------------------->
      <!-- <-------------------------------Inquries end -------------------------------->

      <!-- <-------------------------------Inventory Start -------------------------------->
      <!-- <-------------------------------add item Start -------------------------------->
      <div id="add-item" class="content">
        <div class="wrapper">
          <header>Add item to inventory</header>
          <form action="#">
            <div class="dbl-field">
              <div class="input-field">
                <label>Item Name</label>
                <input type="text" name="name" placeholder="Enter item name" />

                <label>Item Price</label>
                <input
                  type="text"
                  name="price"
                  placeholder="Enter item price"
                />

                <label>Item Quantity</label>
                <input
                  type="text"
                  name="quantity"
                  placeholder="Enter item quantity"
                />
              </div>
            </div>

            <div class="message">
              <textarea
                placeholder="Write your description"
                name="message"
              ></textarea>
            </div>
            <label>Add a photo</label>
            <input type="file" id="myFile" name="filename" />
            <div class="button-area">
              <button type="submit">Add item</button>
              <span></span>
            </div>
          </form>
        </div>
      </div>
      <!-- <-------------------------------add item end -------------------------------->
      <!-- <-------------------------------delete item start -------------------------------->
      <div id="delete-item" class="content table-container">
        <h2>Delete Item</h2>
        <br />
        <label class="emhistory"><b>Choose Item</b></label>
        <select required>
          <option disabled selected>Choose Item</option>
          <option>camera</option>
          <option>chip</option>
          <option>stand</option>
        </select>
        <div>
          <span class="overlay"></span>
        </div>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Item Name</th>
              <th>Item ID</th>
              <th>Description</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Camera</td>
              <td>123</td>
              <td>nikon camera</td>
              <td>200</td>
              <td>10</td>
              <td>
                <button>Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------delete item end -------------------------------->
      <!-- <-------------------------------check quantity start -------------------------------->
      <div id="check-item-quantity" class="content table-container">
        <h2>check quantity of Item</h2>
        <br />
        <label class="emhistory"><b>Choose Item</b></label>
        <select required>
          <option disabled selected>Choose Item</option>
          <option>camera</option>
          <option>chip</option>
          <option>stand</option>
        </select>
        <div>
          <span class="overlay"></span>
        </div>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Item Name</th>
              <th>Item ID</th>
              <th>Description</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Camera</td>
              <td>123</td>
              <td>nikon camera</td>
              <td>20000</td>
              <td>10</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------check quantity end -------------------------------->
      <!-- <-------------------------------Inventory end -------------------------------->
      <!-- <-------------------------------Renting Start -------------------------------->
      <!-- <-------------------------------Renting Update Start -------------------------------->
      <div id="update-renting-resources" class="content">
        <div class="wrapper">
          <header>Add Renting Resources</header>
          <form action="#">
            <div class="dbl-field">
              <div class="input-field">
                <label>Item Name</label>
                <input type="text" name="name" placeholder="Enter item name" />

                <label>Item Price</label>
                <input
                  type="text"
                  name="price"
                  placeholder="Enter item price"
                />
              </div>
            </div>

            <div class="message">
              <textarea
                placeholder="Write your description"
                name="message"
              ></textarea>
            </div>
            <label>Add a photo</label>
            <input type="file" id="myFile" name="filename" />
            <div class="button-area">
              <button type="submit">Add item</button>
              <span></span>
            </div>
          </form>
        </div>
      </div>

      <!-- <-------------------------------Renting Update end -------------------------------->
      <!-- <-------------------------------delete renting resources start -------------------------------->
      <div id="delete-renting-resources" class="content table-container">
        <h2>Delete Renting Resources</h2>
        <br />
        <label class="emhistory"><b>Choose Item</b></label>
        <select required>
          <option disabled selected>Choose Item</option>
          <option>camera</option>
          <option>chip</option>
          <option>stand</option>
        </select>
        <div>
          <span class="overlay"></span>
        </div>

        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Item Name</th>
              <th>Item ID</th>
              <th>Description</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Camera</td>
              <td>123</td>
              <td>nikon camera</td>
              <td>200</td>
              <td>
                <button>Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------delete renting resources end -------------------------------->
      <!-- <-------------------------------Renting history start -------------------------------->
      <div id="renting-history" class="content table-container">
        <h2>Renting History</h2>
        <br />
        <div>
        <a href="orders_rents_report.html">
          <button class="clearbtn">Generate Insights Report</button>
          </a>
          <span class="overlay"></span>
        </div>
        <br>
        <table class="application-list">
        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Product ID</th>
                            <th>Days</th>
                            <th>Price</th>
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
                                <td><?php echo $row['rent_date']; ?></td>
                                <td><?php echo $row['rent_status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
        </table>
      </div>
      <!-- <-------------------------------Renting history end -------------------------------->

      <!-- <-------------------------------check renting start-------------------------------->
      <div id="check-renting" class="content table-container">
        <h2>Check Rentings</h2>
        <br />
        <label class="emhistory"><b>Choose Customer ID</b></label>
        <select required>
          <option disabled selected>Choose ID</option>
          <option>kavi1</option>
          <option>san1</option>
          <option>nuwan2</option>
        </select>
        <div>
          <span class="overlay"></span>
        </div>


        <br />
        <table class="application-list">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Rent ID</th>
              <th>Customer ID</th>
              <th>Start Date</th>
              <th>Due Date</th>
              <th>Price</th>
              <th>Description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Kavidnu</td>
              <td>123</td>
              <td>kv1</td>
              <td>2022-12-14</td>
              <td>2022-12-19</td>
              <td>5000</td>
              <td>nikon cam with tripod</td>
              <td>Ongoing</td>
              <td><button class="clearbtn">complete</button></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- <-------------------------------check renting end-------------------------------->

      <!-- <-------------------------------Renting end -------------------------------->
      <!-- <-------------------------------notify discounts and promotions start -------------------------------->
      <div id="notify-discounts" class="content">
        <div class="wrapper2">
          <h2>Notify Discounts And Promotions</h2>
          <form action="#">
            <div class="input-box">
              <input type="text" placeholder="Enter Item Name" required />
            </div>

            <div class="input-box">
              <input type="text" placeholder="Enter Item ID" required />
            </div>
            <div class="input-box">
              <input type="text" placeholder="Enter  Item Price" required />
            </div>
            <div class="input-box">
              <input type="text" placeholder="Enter Presentage" required />
            </div>
            <div class="input-box">
              <input type="text" placeholder="Expiry Date" required />
            </div>

            <div class="message">
              <textarea
                placeholder="Write your description"
                name="message"
              ></textarea>
            </div>
            <label>Add a photo</label>
            <input type="file" id="myFile" name="filename" />
            <div class="button-area">
              <button type="submit">NOTIFY</button>
              <span></span>
            </div>
          </form>
        </div>
      </div>

      <!-- <-------------------------------notify discounts and promotions end -------------------------------->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
    <script>
      const section = document.querySelector("section"),
        overlay = document.querySelector(".overlay"),
        showBtn = document.querySelector(".show-modal"),
        closeBtn = document.querySelector(".close-btn");

      showBtn.addEventListener("click", () => section.classList.add("active"));

      overlay.addEventListener("click", () =>
        section.classList.remove("active")
      );

      closeBtn.addEventListener("click", () =>
        section.classList.remove("active")
      );

    </script>

<script>
  document.getElementById('logout').addEventListener('click', function() {
     
      
      // Redirect to the login page
      window.location.href = 'index.html'; 
  });
</script>
  </body>
</html>
