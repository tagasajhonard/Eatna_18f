<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sagility";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if POST request is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cubicle_number = $_POST["cubicle_number"];
    $cpu_sr = $_POST["cpu_sr"];
    $monitor1_sr = $_POST["monitor1_sr"];
    $monitor2_sr = $_POST["monitor2_sr"];
    $cisco_sr = $_POST["cisco_sr"];

    // Check for duplicate serial numbers (excluding the current cubicle number)
    $checkSql = "SELECT * FROM eatna_18f WHERE 
                 (cpu_sr = ? OR monitor1_sr = ? OR monitor2_sr = ? OR cisco_sr = ?)
                 AND cubicle_number != ?";

    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("sssss", $cpu_sr, $monitor1_sr, $monitor2_sr, $cisco_sr, $cubicle_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "duplicate"; // JavaScript will handle this response
    } else {
        // SQL to update record
        $sql = "UPDATE eatna_18f 
                SET cpu_sr = ?, monitor1_sr = ?, monitor2_sr = ?, cisco_sr = ?
                WHERE cubicle_number = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $cpu_sr, $monitor1_sr, $monitor2_sr, $cisco_sr, $cubicle_number);

        if ($stmt->execute()) {
            echo "success"; // JavaScript will handle this response
        } else {
            echo "error";
        }
    }
    $stmt->close();
}

$conn->close();
?>

