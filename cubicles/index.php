<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/switchForm.css">
    
</head>
<style>

</style>

<body>
    <div id="switchForm" class="switch-form" style="display: ;">

        <h4>What would you like to switch?</h4>
        <label for="unitType">Select the unit to switch:</label>
        <select id="unitType">
            <option value="CPU">CPU</option>
            <option value="Monitor1">Monitor 1</option>
            <option value="Monitor2">Monitor 2</option>
            <option value="Cisco">Cisco</option>
            <option value="All Units">All Units</option>
        </select><br><br>

        <label for="unitSelect">Select two Cubicles to switch:</label>
        <div class="cube-number">
            <select id="unitSelect1" class="top">
                <option value="">Select Cubicle</option>
                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sagility";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Database connection failed: " . $conn->connect_error);
                }
                echo "Database connected successfully!";

                // Fetch occupied cubicles
                $query = "SELECT cubicle_number FROM eatna_18f WHERE status = 'Occupied'";
                $result = $conn->query($query);

                // Error check for first query
                if (!$result) {
                    die("Query failed: " . $conn->error);
                }

                // Loop through occupied cubicles and add them as options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['cubicle_number']}'>{$row['cubicle_number']}</option>";
                    }
                } else {
                    echo "<option value=''>No occupied cubicles found</option>";
                }
                ?>
            </select>

            <label class="toLbl">---------- To ----------</label>

            <select id="unitSelect2" class="bot">
                <option value="">Select Cubicle</option>
                <?php
                // Run the query again for the second select
                $result = $conn->query($query);

                // Error check for second query
                if (!$result) {
                    die("Query failed: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['cubicle_number']}'>{$row['cubicle_number']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <button id="switchBtn" onclick="" class="switch-button">Switch</button>
        <button onclick="cancelForm ()" class="cancel-button">Cancel</button>
    </div>
</body>
<script>
</script>

</html>