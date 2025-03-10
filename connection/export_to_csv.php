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

$sql = "SELECT * FROM eatna_18f";
$result = $conn->query($sql);

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="eatna_18f_data.csv"');

$output = fopen('php://output', 'w');

// Write the column headers (replace with your actual column names)
fputcsv($output, ['ID', 'Cubicle Number', 'CPU Serial', 'Monitor 1 Serial', 'Monitor 2 Serial', 'Cisco Serial', 'Account']);

// Write the data rows
while ($data = $result->fetch_assoc()) {
    // Map the data to the correct column order based on your query
    fputcsv($output, [
        $data['id'],
        $data['cubicle_number'],
        $data['cpu_sr'],
        $data['monitor1_sr'],
        $data['monitor2_sr'],
        $data['cisco_sr'],
        'Eatna'
    ]);
}

fclose($output);
$conn->close();
exit;
?>
