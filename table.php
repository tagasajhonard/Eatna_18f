<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/miniForm.css">
    <link rel="stylesheet" href="css/findForm.css">
    <link rel="stylesheet" href="css/editForm.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/burger.css">

    <script src="javascript/compile.js"></script>
    <script src="javascript/form.js"></script>

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
            <!-- <li><img src="image/table.png" class="icon"> Table</li> -->
            <li id="findLi"><img src="image/find.png" class="icon">Find</li>
            <!-- <li><img src="image/convert.png" class="icon"> Switch Unit</li> -->
            <li id="downloadBtn"><img src="image/database.png" class="icon">DB Backup</li>
            <li id="downloadBtn" onclick="window.location.href='connection/export_to_csv.php'"><img src="image/xls.png" class="icon">Download Excel</li>

            <li class="legend-toggle" onclick="toggleLegend()">
                <img src="image/map-legend.png" class="icon"> Legends
            </li>

        </ul>
        <div id="legendContent" class="legend-box" style="display: none;">
            <p><div class="Mbtn">M</div> Available Cubicle</p>
            <p><div class="chkBtn">✔</div> Occupied Cubicle</p>
            <p><div class="redBtn">✔</div> Searched Cubicle</p>
        </div>
    </details>

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

    <table>
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

<div id="miniForm" class="mini-form">
    <div class="mini-header">
        <span id="cubicleTitle">Details</span>
        <button class="close-btn" onclick="closeMiniForm()">✖</button>
    </div>
    <div class="mini-content">
        <div class="mini-row">
            <span class="mini-label">Cubicle Number:</span>
            <span id="miniCubicleNumber" class="mini-value">N/A</span>
        </div>
        <div class="mini-row">
            <span class="mini-label">CPU S/N:</span>
            <span id="miniCpuSr" class="mini-value">N/A</span>
        </div>
        <div class="mini-row">
            <span class="mini-label">Monitor 1 S/N:</span>
            <span id="miniMonitor1" class="mini-value">N/A</span>
        </div>
        <div class="mini-row">
            <span class="mini-label">Monitor 2 S/N:</span>
            <span id="miniMonitor2" class="mini-value">N/A</span>
        </div>
        <div class="mini-row">
            <span class="mini-label">Cisco S/N:</span>
            <span id="miniCisco" class="mini-value">N/A</span>
        </div>
    </div>
    <div class="mini-actions">
        <button class="edit-btn" onclick="openEditForm()">Update</button>
    </div>
</div>

<div id="editOverlay" class="over"></div>

<div id="editForm" class="edit-form" style="display: none;">
    <div class="mini-header">
        <span>Update Details</span>
        <button class="close-btn" onclick="closeEditForm()">✖</button>
    </div>
    <div class="mini-content">
        <div class="mini-rows">
            <label class="mini-label">Cubicle Number:</label>
            <input type="text" id="editCubicleNumber" readonly>
        </div>
        <div class="mini-rows">
            <label class="mini-label">CPU S/N:</label>
            <input type="text" id="editCpuSr">
        </div>
        <div class="mini-rows">
            <label class="mini-label">Monitor 1 S/N:</label>
            <input type="text" id="editMonitor1">
        </div>
        <div class="mini-rows">
            <label class="mini-label">Monitor 2 S/N:</label>
            <input type="text" id="editMonitor2">
        </div>
        <div class="mini-rows">
            <label class="mini-label">Cisco S/N:</label>
            <input type="text" id="editCisco">
        </div>
    </div>
    <div class="mini-actions">
        <button class="save-btn" onclick="saveEditDetails()">Save</button>
    </div>
</div>
</body>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
        window.location.href = 'connection/download_backup.php';
    });
    
</script>
<script src="javascript/findForm.js"></script>
<script src="javascript/check.js"></script>
<script src="javascript/editForm.js"></script>
<script type="text/javascript">

</script>
</html>