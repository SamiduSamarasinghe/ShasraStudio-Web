<?php
session_start();
header('Content-Type: application/json');

// Mock session data for demonstration
// In real implementation, fetch these from the session storage
$response = [
    'occupation' => $_SESSION['occupation']
];

echo json_encode($response);
?>

