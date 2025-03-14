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

$sql = "SELECT cubicle_number FROM eatna_14f";
$result = $conn->query($sql);

$cubicles = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $cubicles[] = $row['cubicle_number'];
    }
} else {
    error_log("Database query error: " . $conn->error);
}

$conn->close();
echo json_encode($cubicles);
?>
