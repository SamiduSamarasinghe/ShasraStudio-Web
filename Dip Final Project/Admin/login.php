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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT Password FROM managerlog WHERE Username = ?");
    $stmt->bind_param("s", $inputUsername);

    // Execute statement
    $stmt->execute();
    $stmt->bind_result($dbPassword);
    $stmt->fetch();
    $stmt->close();

    // Debugging: output fetched password
    if ($dbPassword === null) {
        echo "<script>alert('Username not found');</script>";
    } else {
        echo "<script>console.log('Fetched password: " . $dbPassword . "');</script>";
    }

    // Verify password
    if ($dbPassword && $inputPassword === $dbPassword) {
        // Password is correct, start a session and redirect to the manager's dashboard
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $inputUsername;
        header("Location: dashboard.php");
        exit();
    } else {
        // Password is not correct, show an error message
        echo "<script>alert('Invalid username or password');</script>";
    }
}

$conn->close();
?>
