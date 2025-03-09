<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "sagility";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get occupied cubicles
$sql = "SELECT cubicle_number FROM eatna_18f"; // Adjust table name & field
$result = $conn->query($sql);

$cubicles = [];
while ($row = $result->fetch_assoc()) {
    $cubicles[] = $row['cubicle_number'];
}

$conn->close();

// Return occupied cubicles as JSON
echo json_encode($cubicles);
?>
