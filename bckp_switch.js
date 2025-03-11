<?php
include 'connection/connection.php';

if (isset($_POST['unitType'], $_POST['cubicle1'], $_POST['cubicle2'])) {
    $unitType = $_POST['unitType'];
    $cubicle1 = $_POST['cubicle1'];
    $cubicle2 = $_POST['cubicle2'];

    // Handle 'All Units' Logic
    if ($unitType === 'All Units') {
        $query1 = "SELECT * FROM eatna_18f WHERE cubicle_number = '$cubicle1'";
        $query2 = "SELECT * FROM eatna_18f WHERE cubicle_number = '$cubicle2'";

        $result1 = $conn->query($query1);
        $result2 = $conn->query($query2);

        if ($result1->num_rows > 0 && $result2->num_rows > 0) {
            $data1 = $result1->fetch_assoc();
            $data2 = $result2->fetch_assoc();

            $conn->query("UPDATE eatna_18f SET cubicle_number = 'TEMP' WHERE cubicle_number = '$cubicle1'");
            $conn->query("UPDATE eatna_18f SET cubicle_number = '$cubicle1' WHERE cubicle_number = '$cubicle2'");
            $conn->query("UPDATE eatna_18f SET cubicle_number = '$cubicle2' WHERE cubicle_number = 'TEMP'");

            echo "Successfully switched all units between Cubicle $cubicle1 and Cubicle $cubicle2.";
        } else {
            echo "Error: One or both cubicles not found.";
        }
    } 

    else {
        $columnMap = [
            'CPU' => 'cpu_sr',
            'Monitor1' => 'monitor1_sr',
            'Monitor2' => 'monitor2_sr',
            'Cisco' => 'cisco_sr'
        ];

        if (isset($columnMap[$unitType])) {
            $column = $columnMap[$unitType];

            // Swap individual units
            $conn->query("UPDATE eatna_18f SET $column = (
                SELECT tmp.$column 
                FROM (SELECT $column FROM eatna_18f WHERE cubicle_number = '$cubicle2') AS tmp
            ) WHERE cubicle_number = '$cubicle1'");

            $conn->query("UPDATE eatna_18f SET $column = (
                SELECT tmp.$column 
                FROM (SELECT $column FROM eatna_18f WHERE cubicle_number = '$cubicle1') AS tmp
            ) WHERE cubicle_number = '$cubicle2'");

            echo "$unitType successfully switched between Cubicle $cubicle1 and Cubicle $cubicle2.";
        } else {
            echo "Invalid unit type selected.";
        }
    }
} else {
    echo "Error: Missing required data.";
}
?>
