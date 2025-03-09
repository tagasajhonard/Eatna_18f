document.getElementById("findLi").addEventListener("click", function () { 
    document.getElementById("findForm").style.display = "block";
    document.getElementById("overlay").style.display = "block";
});

function findDevice() {
    const deviceType = document.getElementById("deviceType").value;  // Get device type (monitor, cpu, cisco)
    const serialNumber = document.getElementById("serialNumber").value;  // Get serial number
    
    // Check if serial number is provided
    if (!serialNumber) {
        alert("Please enter a serial number.");
        return;
    }

    fetch('find_device.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ deviceType: deviceType, serialNumber: serialNumber })
    })
.then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Cubicle Number: " + data.cubicleNumber);

            // Find the button with the corresponding value attribute
            const cubicleBtn = document.querySelector(`button[value='${data.cubicleNumber}']`);
            
            if (cubicleBtn) {
                cubicleBtn.style.backgroundColor = "green"; // Change button color
                cubicleBtn.style.color = "white"; // Adjust text color
            } else {
                alert("No matching button found for this cubicle.");
            }
        } else {
            alert("No data found for the serial number.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("There was an error processing your request.");
    });

    document.getElementById("findForm").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}

function cancelFind() {
    document.getElementById("findForm").style.display = "none";
    document.getElementById("overlay").style.display = "none";
}
