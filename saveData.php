<div id="submitForm">
    <h3>Submit Data</h3>
    <form id="dataForm" method="POST" action="data.php">

        <label for="buttonValue">Cubicle Number:</label>
        <input type="text" id="buttonValue" name="buttonValue" readonly value="12345">
        <br>

        <label for="cpuSerialNumber" >CPU S/R:</label>
        <input type="text" id="cpuSerialNumber" name="cpuSerialNumber" required>
        <br>

        <label for="monitor1SerialNumber" >Monitor 1 S/R:</label>
        <input type="text" id="monitor1SerialNumber" name="monitor1SerialNumber" required>
        <br>

        <label for="monitor2SerialNumber">Monitor 2 S/R:</label>
        <input type="text" id="monitor2SerialNumber" name="monitor2SerialNumber" required>
        <br>

        <label for="ciscoSerialNumber">Cisco S/R:</label>
        <input type="text" id="ciscoSerialNumber" name="ciscoSerialNumber" required>
        <br>

        <button type="submit" name="submit" class="submitBtn">Submit</button>
        <button type="button" onclick="closeForm()" class="cancelBtn">Cancel</button>
    </form>
</div>

<div id="messageContainer"></div>

<div id="overlay"></div>

