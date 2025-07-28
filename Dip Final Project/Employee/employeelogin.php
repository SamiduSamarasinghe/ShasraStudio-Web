<?php
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
    $stmt = $conn->prepare("SELECT Full_Name, Password, Occupation FROM employeelog WHERE Full_Name = ?");
    $stmt->bind_param("s", $inputUsername);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Bind result variables
        $stmt->bind_result($username, $dbPassword, $occupation);
        $stmt->fetch();

        // Verify password
        if ($inputPassword === $dbPassword) {
            // Password is correct, start a session and redirect to the appropriate page
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['occupation'] = $occupation;

            header("Location: employee.html");
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid username or password');</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Username not found');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
