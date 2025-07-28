document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('dashboard-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadDashboardPanel();
    });

    document.getElementById('salary-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadSalaryPanel();
    });

    document.getElementById('leaves-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadLeavesPanel();
    });

    document.getElementById('tasks-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadTasksPanel();
    });

    document.getElementById('attendance-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadAttendancePanel();
    });

    document.getElementById('plan-events-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadPlanEventsPanel();
    });

    document.getElementById('messages-link').addEventListener('click', function (e) {
        e.preventDefault();
        loadMessagesPanel();
    });
});

function loadDashboardPanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Dashboard</h2>
            <div class="search-container">
                <input type="text" placeholder="Search here...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            <div class="header-icons">
                <i class="fas fa-bell"></i>
                <i class="fas fa-comment"></i>
                <i class="fas fa-user-circle"></i>
            </div>
        </div>
        <div class="card-container">
            <div class="card gradient">
                <h3>8</h3>
                <p>New Tasks</p>
            </div>
            <div class="card gradient">
                <h3>33</h3>
                <p>New Events To Plan</p>
            </div>
            <div class="card gradient">
                <h3>6</h3>
                <p>New Messages</p>
            </div>
            <div class="card gradient">
                <h3>652</h3>
                <p>Total Events</p>
            </div>
        </div>
        <div class="charts">
            <div class="chart card">
                <h3>Account Overview</h3>
                <div id="piechart"></div>
            </div>
            <div class="chart card">
                <h3>Activity</h3>
                <div id="barchart"></div>
            </div>
        </div>
        <div class="transaction-section">
            <div class="card">
                <h3>Transfer Salaries</h3>
                <div class="transfer-salaries">
                    <div class="manager-info">
                        <img src="manager.jpg" alt="Manager">
                        <div>
                            <h4>Manager</h4>
                            <p>Your Balance: RS 24,571.93</p>
                        </div>
                    </div>
                    <div class="employee-info">
                        <p>Employees</p>
                        <div class="employee-avatars">
                            <img src="employee1.jpg" alt="Employee 1">
                            <img src="employee2.jpg" alt="Employee 2">
                            <img src="employee3.jpg" alt="Employee 3">
                            <img src="employee4.jpg" alt="Employee 4">
                        </div>
                    </div>
                    <div class="amount-input">
                        <label for="amount">Insert Amount</label>
                        <input type="number" id="amount" placeholder="20,000">
                    </div>
                    <button class="transfer-button">TRANSFER NOW</button>
                </div>
            </div>
            <div class="card">
                <h3>Spending</h3>
                <div class="spending-info">
                    <div class="spending-item">
                        <p>Investment</p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 70%;"></div>
                        </div>
                        <p>RS 1415 / RS 2000</p>
                    </div>
                    <div class="spending-item">
                        <p>Salaries</p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 30%;"></div>
                        </div>
                        <p>RS 1567 / RS 5000</p>
                    </div>
                    <div class="spending-item">
                        <p>Order Cost</p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 10%;"></div>
                        </div>
                        <p>RS 470 / RS 10000</p>
                    </div>
                    <div class="spending-item">
                        <p>Renting</p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 97%;"></div>
                        </div>
                        <p>RS 3890 / RS 4000</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <h3>Transaction Overview</h3>
                <div id="transaction-overview"></div>
                <button class="download-report">Download Report</button>
            </div>
        </div>
    `;
    // Redraw charts if necessary
    drawCharts();
}

function loadSalaryPanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Salary</h2>
        </div>
        <div class="salary-details">
            <div class="card">
                <h3>Salary Information</h3>
                <p>Details about the salary.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Basic Pay</th>
                            <th>Bonuses</th>
                            <th>Deductions</th>
                            <th>Net Pay</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>January</td>
                            <td>RS 20,000</td>
                            <td>RS 2,000</td>
                            <td>RS 500</td>
                            <td>RS 21,500</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Salary History</h3>
                <p>History of past salary transactions.</p>
                <ul>
                    <li>January: RS 21,500</li>
                    <li>February: RS 21,500</li>
                    <!-- More list items as needed -->
                </ul>
            </div>
        </div>
    `;
}

function loadLeavesPanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Leaves</h2>
        </div>
        <div class="leaves-details">
            <div class="card">
                <h3>Leave Requests</h3>
                <p>Details about leave requests.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sick Leave</td>
                            <td>March 1, 2024</td>
                            <td>March 5, 2024</td>
                            <td>Approved</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Leave History</h3>
                <p>History of past leaves.</p>
                <ul>
                    <li>Sick Leave: March 1-5, 2024</li>
                    <li>Annual Leave: April 10-20, 2024</li>
                    <!-- More list items as needed -->
                </ul>
            </div>
        </div>
    `;
}

function loadTasksPanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Tasks</h2>
        </div>
        <div class="tasks-details">
            <div class="card">
                <h3>Task List</h3>
                <p>Details about the tasks.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Due Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Complete Project Report</td>
                            <td>June 5, 2024</td>
                            <td>In Progress</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Completed Tasks</h3>
                <p>History of completed tasks.</p>
                <ul>
                    <li>Design Landing Page: Completed on May 25, 2024</li>
                    <li>Update Database Schema: Completed on May 30, 2024</li>
                    <!-- More list items as needed -->
                </ul>
            </div>
        </div>
    `;
}

function loadAttendancePanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Attendance</h2>
        </div>
        <div class="attendance-details">
            <div class="card">
                <h3>Attendance Records</h3>
                <p>Details about attendance records.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>May 30, 2024</td>
                            <td>Present</td>
                            <td>9:00 AM</td>
                            <td>5:00 PM</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Attendance History</h3>
                <p>History of past attendance.</p>
                <ul>
                    <li>May 30, 2024: Present</li>
                    <li>May 29, 2024: Present</li>
                    <!-- More list items as needed -->
                </ul>
            </div>
        </div>
    `;
}

function loadPlanEventsPanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Plan Events</h2>
        </div>
        <div class="events-details">
            <div class="card">
                <h3>Upcoming Events</h3>
                <p>Details about upcoming events.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Team Building Retreat</td>
                            <td>June 15, 2024</td>
                            <td>Mountain Resort</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Event History</h3>
                <p>History of past events.</p>
                <ul>
                    <li>Product Launch: May 20, 2024</li>
                    <li>Annual Meeting: April 10, 2024</li>
                    <!-- More list items as needed -->
                </ul>
            </div>
            <div class="card">
                <h3>Create New Event</h3>
                <p>Form to create a new event.</p>
                <form>
                    <label for="event-name">Event Name</label>
                    <input type="text" id="event-name" placeholder="Event Name">
                    <label for="event-date">Event Date</label>
                    <input type="date" id="event-date">
                    <label for="event-location">Event Location</label>
                    <input type="text" id="event-location" placeholder="Event Location">
                    <button type="submit">Create Event</button>
                </form>
            </div>
        </div>
    `;
}

function loadMessagesPanel() {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <div class="header">
            <h2>Messages</h2>
        </div>
        <div class="messages-details">
            <div class="card">
                <h3>Inbox</h3>
                <p>Details about the messages.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>Meeting Reminder</td>
                            <td>June 1, 2024</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Sent Messages</h3>
                <p>History of sent messages.</p>
                <ul>
                    <li>Project Update to Jane Smith: May 30, 2024</li>
                    <li>Meeting Schedule to Team: May 28, 2024</li>
                    <!-- More list items as needed -->
                </ul>
            </div>
            <div class="card">
                <h3>Compose Message</h3>
                <p>Form to compose a new message.</p>
                <form>
                    <label for="recipient">Recipient</label>
                    <input type="text" id="recipient" placeholder="Recipient">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="Subject">
                    <label for="message-body">Message</label>
                    <textarea id="message-body" placeholder="Write your message here..."></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    `;
}

function drawCharts() {
    // Load Google Charts
    google.charts.load('current', { packages: ['corechart', 'bar'] });
    google.charts.setOnLoadCallback(drawPieChart);
    google.charts.setOnLoadCallback(drawBarChart);

    function drawPieChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 8],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 8]
        ]);

        var options = {
            title: 'My Daily Activities',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    function drawBarChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses', 'Profit'],
            ['2014', 1000, 400, 200],
            ['2015', 1170, 460, 250],
            ['2016', 660, 1120, 300],
            ['2017', 1030, 540, 350]
        ]);

        var options = {
            chart: {
                title: 'Company Performance',
                subtitle: 'Sales, Expenses, and Profit: 2014-2017',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('barchart'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
}

// Load the default dashboard panel on page load
loadDashboardPanel();
