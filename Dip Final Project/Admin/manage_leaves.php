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

// Check if action is set (approve or deny)
if (isset($_POST['action']) && isset($_POST['leave_id'])) {
    $action = $_POST['action'];
    $leave_id = $_POST['leave_id'];

    // Prepare update statement
    $sql = "";
    if ($action === 'approve') {
        $sql = "UPDATE employee_leaves SET status = 'Approved' WHERE id = ?";
    } elseif ($action === 'deny') {
        $sql = "UPDATE employee_leaves SET status = 'Cancelled' WHERE id = ?";
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $leave_id);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Leave status updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to update leave status.'));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
    exit;
}

// Fetch all leave requests
$sql = "SELECT id, employee_id, date_from, date_to, reason, status FROM employee_leaves";
$result = $conn->query($sql);

// Store results in an array
$leaves = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $leaves[] = $row;
    }
}

// Close connection
$conn->close();
?>

<!-- HTML Output for Leaves Table -->
<table id="leave-table">
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Duration (Days)</th>
            <th>Reason</th>
            <th>Action</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($leaves as $leave): ?>
        <tr>
            <td><?php echo $leave['employee_id']; ?></td>
            <td><?php echo $leave['date_from']; ?></td>
            <td><?php echo $leave['date_to']; ?></td>
            <td><?php
                $datetime1 = new DateTime($leave['date_from']);
                $datetime2 = new DateTime($leave['date_to']);
                $interval = $datetime1->diff($datetime2);
                echo $interval->format('%a days');
                ?></td>
            <td><?php echo $leave['reason']; ?></td>
            <td>
                <select class="action-select">
                    <option value="">Select Action</option>
                    <option value="approve">Approve</option>
                    <option value="deny">Deny</option>
                </select>
                <button class="update-status" data-leave-id="<?php echo $leave['id']; ?>">Submit</button>
            </td>
            <td class="status"><?php echo $leave['status']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.update-status').click(function() {
        var leave_id = $(this).data('leave-id');
        var action = $(this).siblings('.action-select').val();

        $.ajax({
            url: 'manage_leaves.php',
            type: 'POST',
            data: {
                action: action,
                leave_id: leave_id
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Update status cell in the table
                    var statusCell = $('button[data-leave-id="' + leave_id + '"]').closest('tr').find('.status');
                    statusCell.text(action === 'approve' ? 'Approved' : 'Cancelled');
                    statusCell.removeClass().addClass('status ' + (action === 'approve' ? 'approved' : 'denied'));
                    alert('Leave status updated successfully.');
                } else {
                    alert('Failed to update leave status.');
                }
            },
            error: function() {
                alert('Error: Failed to update leave status.');
            }
        });
    });
});
</script>
