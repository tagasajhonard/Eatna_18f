    function openEditForm() {
    document.getElementById("editForm").style.display = "block";
    document.getElementById("editOverlay").style.display = "block";

    // Get current values from mini form
    document.getElementById("editCubicleNumber").value = document.getElementById("miniCubicleNumber").innerText;
    document.getElementById("editCpuSr").value = document.getElementById("miniCpuSr").innerText;
    document.getElementById("editMonitor1").value = document.getElementById("miniMonitor1").innerText;
    document.getElementById("editMonitor2").value = document.getElementById("miniMonitor2").innerText;
    document.getElementById("editCisco").value = document.getElementById("miniCisco").innerText;
}

// Function to close the Edit Form
function closeEditForm() {
    document.getElementById("editForm").style.display = "none";
    document.getElementById("editOverlay").style.display = "none";
}
 // Function to save edited details and update database
function saveEditDetails() {
    // Get updated values from input fields
    let cubicleNumber = document.getElementById("editCubicleNumber").value;
    let cpuSr = document.getElementById("editCpuSr").value;
    let monitor1 = document.getElementById("editMonitor1").value;
    let monitor2 = document.getElementById("editMonitor2").value;
    let cisco = document.getElementById("editCisco").value;

    // Prepare data to send
    let formData = new FormData();
    formData.append("cubicle_number", cubicleNumber);
    formData.append("cpu_sr", cpuSr);
    formData.append("monitor1_sr", monitor1);
    formData.append("monitor2_sr", monitor2);
    formData.append("cisco_sr", cisco);

    // Send data to PHP using fetch()
    fetch("update_details.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            alert("Details Updated Successfully!");

            // Update the mini form UI with new values
            document.getElementById("miniCpuSr").innerText = cpuSr;
            document.getElementById("miniMonitor1").innerText = monitor1;
            document.getElementById("miniMonitor2").innerText = monitor2;
            document.getElementById("miniCisco").innerText = cisco;

            // Close edit form
            closeEditForm();
        } else {
            alert("Failed to update details: " + data);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred while updating.");
    });
}
