<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/findForm.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/burger.css">

    <script src="javascript/compile.js"></script>
    <script src="javascript/form.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style type="text/css">
    .mini-form {
    display: none;
    position: absolute;
    background: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    z-index: 1000;
}

.mini-form button {
    display: block;
    width: 100%;
    margin-top: 5px;
}

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
            <li><img src="image/table.png" class="icon"> Table</li>
            <li id="findLi"><img src="image/find.png" class="icon">Find</li>
            <li id="downloadBtn"><img src="image/database.png" class="icon">DB backup</li>
            <li id="downloadBtn" onclick="window.location.href='connection/export_to_csv.php'"><img src="image/xls.png" class="icon">Download Excel</li>
        </ul>
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

</body>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
        window.location.href = 'connection/download_backup.php';
    });
</script>
<script src="javascript/findForm.js"></script>
<script src="javascript/check.js"></script>
<script type="text/javascript">

</script>
</html>