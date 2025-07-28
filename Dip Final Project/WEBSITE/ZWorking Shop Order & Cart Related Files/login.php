<?php
// login.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo 'Please fill in both fields.';
        exit();
    }

    $stmt = $con->prepare("SELECT Password FROM customer WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            echo 'success';
        } else {
            echo 'Invalid Username or Password.';
        }
    } else {
        echo 'Invalid Username or Password.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: http://localhost/WEBSITE/home/log_in.html");
    exit();
}
?>
