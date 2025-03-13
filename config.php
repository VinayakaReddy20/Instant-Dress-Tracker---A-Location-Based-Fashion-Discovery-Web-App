<?php
$servername = "localhost";
$username = "root";    // Ensure this is the correct username
$password = "09[8BlRZTZ]1sb.7";        // If no password is set, leave it empty or set the correct one
$dbname = "shopplatform";  // Your actual database name here

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
 