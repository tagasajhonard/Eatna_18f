<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sagility"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['deviceType']) || !isset($data['serialNumber'])) {
    echo json_encode(['success' => false, 'message' => 'Device type and serial number are required.']);
    exit;
}

$deviceType = $data['deviceType']; 
$serialNumber = $data['serialNumber']; 

$deviceType = $conn->real_escape_string($deviceType);
$serialNumber = $conn->real_escape_string($serialNumber);

if ($deviceType == 'monitor') {
    $sql = "SELECT cubicle_number FROM eatna_18f WHERE monitor1_sr = ? OR monitor2_sr = ?";
} elseif ($deviceType == 'cpu') {
    $sql = "SELECT cubicle_number FROM eatna_18f WHERE cpu_sr = ?";
} elseif ($deviceType == 'cisco') {
    $sql = "SELECT cubicle_number FROM eatna_18f WHERE cisco_sr = ?";
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid device type.']);
    exit;
}

$stmt = $conn->prepare($sql);

if ($deviceType == 'monitor') {
    $stmt->bind_param("ss", $serialNumber, $serialNumber);
} else {
    $stmt->bind_param("s", $serialNumber);
}

$stmt->execute();

$stmt->bind_result($cubicleNumber);

$response = array();
if ($stmt->fetch()) {
    $response['success'] = true;
    $response['cubicleNumber'] = $cubicleNumber;
} else {
    $response['success'] = false;
    $response['message'] = "No data found for the serial number.";
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
