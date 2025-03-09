<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "sagility";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get cubicle number safely
$cubicleNumber = $_GET['cubicleNumber'] ?? '';

if (empty($cubicleNumber)) {
    die("No cubicle number provided.");
}

// Prepare and execute query
$sql = "SELECT * FROM eatna_18f WHERE cubicle_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cubicleNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo "CPU S/R: " . htmlspecialchars($data['cpu_sr']) . "<br>";
    echo "Monitor S/R: " . htmlspecialchars($data['monitor1_sr']) . "<br>";
} else {
    echo "No data found for cubicle " . htmlspecialchars($cubicleNumber);
}

$stmt->close();
$conn->close();
?>
