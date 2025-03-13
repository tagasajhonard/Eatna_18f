<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "sagility";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Get floor value from URL (e.g., ?floor=18)
$floor = isset($_GET['floor']) ? intval($_GET['floor']) : 18;

// Map floor numbers to corresponding tables
$tableMap = [
    14 => 'eatna_14f',
    18 => 'eatna_18f'
];

// Check if the floor exists in the table map
if (!array_key_exists($floor, $tableMap)) {
    echo json_encode(["error" => "Invalid floor number."]);
    exit;
}

// Fetch data from the corresponding table
$tableName = $tableMap[$floor];
$sql = "SELECT cubicle_number FROM $tableName";
$result = $conn->query($sql);

$cubicles = [];
while ($row = $result->fetch_assoc()) {
    $cubicles[] = strval($row['cubicle_number']);
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($cubicles);
?>
