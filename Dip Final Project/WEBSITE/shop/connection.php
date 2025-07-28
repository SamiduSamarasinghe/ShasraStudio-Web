<?php

$server="localhost";
$user="root";
$pass="";
$DB="sahasrastudiodb";

$con=mysqli_connect($server,$user,$pass,$DB);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
// else
//     echo "Connection Passed"
?>