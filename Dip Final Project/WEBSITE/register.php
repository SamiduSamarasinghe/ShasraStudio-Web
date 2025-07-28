<?php
// register.php

session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['name'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone_number = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($full_name) || empty($username) || empty($address) || empty($phone_number) || empty($email) || empty($password)) {
        echo 'All fields are required.';
        exit();
    }

    // Check if username already exists
    $stmt = $con->prepare("SELECT Username FROM customer WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'Username already taken. Please choose another one.';
        $stmt->close();
        $con->close();
        exit();
    }
    $stmt->close();

    // Insert the new user into the database
    $stmt = $con->prepare("INSERT INTO customer (Full_Name, Username, Address, Phone_Number, Email, Password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $username, $address, $phone_number, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['registered'] = true;
        echo 'Registration successful!';
    } else {
        echo 'Registration failed. Please try again.';
    }

    $stmt->close();
    $con->close();
} else {
    header("Location: register.html");
    exit();
}
