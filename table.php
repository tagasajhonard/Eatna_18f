<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/miniForm.css">
    <link rel="stylesheet" href="css/findForm.css">
    <link rel="stylesheet" href="css/switchForm.css">
    <link rel="stylesheet" href="css/editForm.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/burger.css">

    <link rel="icon" type="image/png" href="image/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style type="text/css">

</style>

<body>

    <details>
        <summary>
            <span>NAV BAR</span>
            <span class="burger">
                <div></div>
                <div></div>
                <div></div>
            </span>
        </summary>
        <ul>
            <li class="legend-toggle" onclick="toggleActions()">
                <img src="image/actions.png" class="icon"> Operations
            </li>

            <div id="actionContent" class="action-btn" style="display: none;">
                <li id="findLi"><img src="image/find.png" class="icon">Find</li>
                <li id="switchUnit"><img src="image/convert.png" class="icon"> Switch Unit</li>
                <li id="downloadBtn"><img src="image/database.png" class="icon">DB Backup</li>
                <li id="downloadBtn" onclick="window.location.href='connection/export_to_csv.php'"><img
                        src="image/xls.png" class="icon">Download Excel</li>
            </div>

            <li class="legend-toggle" onclick="toggleFloor()">
                <img src="image/floors.png" class="icon"> Choose Floor
            </li>

            <div id="floorContent" class="legend-box" style="display: none;">
                <li class="floor-btn" data-floor="11">11th Floor</li>
                <li class="floor-btn" data-floor="12">12th Floor</li>
                <li class="floor-btn" data-floor="14">14th Floor</li>
                <li class="floor-btn" data-floor="15">15th Floor</li>
                <li class="floor-btn" data-floor="16">16th Floor</li>
                <li class="floor-btn" data-floor="17">17th Floor</li>
                <li class="floor-btn" data-floor="18">18th Floor</li>
            </div>

            <li class="legend-toggle" onclick="toggleLegend()">
                <img src="image/map-legend.png" class="icon"> Legends
            </li>

        </ul>

        <div id="legendContent" class="legend-box" style="display: none;">
            <p>
            <div class="Mbtn">M</div> Available Cubicle</p>
            <p>
            <div class="chkBtn">✔</div> Occupied Cubicle</p>
            <p>
            <div class="redBtn">✔</div> Searched Cubicle</p>
        </div>
    </details>

    <div id="switch-overlay" style="display: none;"></div>

    <div id="switchForm" class="switch-form" style="display: none;">

        <h4>What would you like to switch?</h4>
        <label for="unitType">Select the unit to switch:</label>
        <select id="unitType" class="obb">
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

            <label class="toLbl"> To </label>

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


    <div id="overlays" style="display: none;"></div>

    <div id="findForm" style="display: none;">
        <h3>Find Options</h3>
        <form id="findOptionsForm">
            <label for="deviceType">Select Device:</label>
            <select id="deviceType" name="deviceType">
                <option value="monitor">Monitor</option>
                <option value="cpu">CPU</option>
                <option value="cisco">Cisco Phones</option>
            </select><br>
            <label for="deviceType">Serial Number:</label>
            <input type="text" name="serialNumber" id="serialNumber"><br>
            <button type="button" onclick="findDevice()" id="findBtn">Find</button><br>
            <button type="button" onclick="cancelFind()" id="exitBtn">Cancel</button>
        </form>
    </div>

    

    <div id="selectMessage" style="text-align: center; margin-top: 20vh; font-size: 24px; font-weight: bold;">
        Please select a floor first.
    </div>

    <table id="table_14" style="display: none;">
        <tr>
            <td id="a" style="width: auto;">a</td>
        </tr>
        <tr>
            <td id="b">b</td>
        </tr>
        <tr>
            <td id="c" colspan="2">c</td>
            <td id="d">d</td>
        </tr>
        <tr>
            <td id="e">e</td>
            <td id="f">f</td>
            <td id="g">g</td>
        </tr>
    </table>

    <table id="table_18" style="display: none;">
        <tr>
            <td colspan="2"></td>
            <td id="top"></td>
        </tr>
        <tr>
            <td id="midLeft"></td>
            <td></td>
            <td id="hey"></td>
        </tr>
        <tr>
            <td id="leftDiv"></td>
            <td id="midDiv"></td>
            <td id="rightDiv"></td>
        </tr>
    </table>


    <div id="formed"></div>

    <div id="miniForm" class="mini-form"></div>

    <div id="editOverlay" class="over"></div>
    <div id="editForm" class="edit-form" style="display: none;"></div>

</body>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        window.location.href = 'connection/download_backup.php';
    });

</script>
<script src="javascript/findForm.js"></script>

<script src="javascript/editForm.js"></script>
<script type="text/javascript">

    document.getElementById("switchUnit").addEventListener("click", function () {
        document.getElementById("switchForm").style.display = "block";
        document.getElementById("switch-overlay").style.display = "block";
    });

    function cancelForm() {
        document.getElementById("switchForm").style.display = "none";
        document.getElementById("switch-overlay").style.display = "none";
    }
</script>
<script src="javascript/optNum.js"></script>
<script src="javascript/switching.js"></script>
<script type="text/javascript">
    // document.addEventListener("DOMContentLoaded", function () {
    // const floorButtons = document.querySelectorAll(".floor-btn");
    // const selectMessage = document.getElementById("selectMessage");

    // floorButtons.forEach(button => {
    //     button.addEventListener("click", function () {
    //         const selectedFloor = this.getAttribute("data-floor");

    //         // Update URL with the selected floor number
    //         const url = new URL(window.location);
    //         url.searchParams.set("floor", selectedFloor);
    //         window.history.pushState({}, "", url);

    //         // Hide all tables
    //         document.querySelectorAll("table").forEach(table => {
    //             table.style.display = "none";
    //         });

    //         // Hide the message
    //         selectMessage.style.display = "none";

    //         // Show the selected table
    //         const selectedTable = document.getElementById(`table_${selectedFloor}`);
    //         if (selectedTable) {
    //             selectedTable.style.display = "table";
    //         }

    //         // Highlight the active floor
    //         floorButtons.forEach(btn => btn.classList.remove("active-floor"));
    //         this.classList.add("active-floor");
    //     });
    // });

    // // Load floor from URL if available
    // const urlParams = new URLSearchParams(window.location.search);
    // const floorFromURL = urlParams.get("floor");
    // if (floorFromURL) {
    //     const selectedTable = document.getElementById(`table_${floorFromURL}`);
    //     if (selectedTable) {
    //         selectedTable.style.display = "table";
    //         selectMessage.style.display = "none";

    //         const activeButton = document.querySelector(`.floor-btn[data-floor="${floorFromURL}"]`);
    //         if (activeButton) {
    //             activeButton.classList.add("active-floor");
    //             }
    //         }
    //     }
    // });

</script>
    <script src="javascript/check.js"></script>
    <script src="javascript/18f_compile.js"></script>
    <script src="javascript/14f_compile.js"></script>
</html>