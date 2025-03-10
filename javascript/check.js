document.addEventListener("DOMContentLoaded", function () {
    fetch("get_cubicle_data.php")
        .then(response => response.json())
        .then(occupiedCubicles => {
            occupiedCubicles.forEach(cubicle => {
                let button = document.querySelector(`button[value="${cubicle}"]`);
                if (button) {
                    button.innerText = "✔"; // Mark cubicle as occupied
                    button.style.backgroundColor = "#f39c12";
                    button.style.color = "#fff";

                    // Add click event only if cubicle has data
                    button.addEventListener("click", function (event) {
                        updateURL(cubicle);
                        showMiniForm(event, cubicle);
                    });
                }
            });
        })
        .catch(error => console.error("Error fetching cubicle data:", error));

    // Check if URL already has a cubicle number and show mini form
    const urlParams = new URLSearchParams(window.location.search);
    const cubicleFromURL = urlParams.get("cubicle");
    if (cubicleFromURL) {
        showMiniFormFromURL(cubicleFromURL);
    }
});

// Function to update the URL without refreshing the page
function updateURL(cubicleNumber) {
    const newURL = `${window.location.pathname}?cubicle=${cubicleNumber}`;
    history.pushState({ cubicle: cubicleNumber }, "", newURL);
}

// Function to show the mini form
function showMiniForm(event, cubicleNumber) {
    let miniForm = document.getElementById("miniForm");
    if (!miniForm) return;

    // First, display the miniForm to get its dimensions
    miniForm.style.display = "block";

    // Get form dimensions
    let formWidth = miniForm.offsetWidth;
    let formHeight = miniForm.offsetHeight;

    // Calculate the centered position based on cursor location
    let posX = event.clientX;
    let posY = event.clientY - formHeight / 2;

    // Set position
    miniForm.style.top = `${posY}px`;
    miniForm.style.left = `${posX}px`;

    // Fetch and display cubicle data
    fetchCubicleData(cubicleNumber);
}

// Function to show mini form when page is loaded with a cubicle in URL
function showMiniFormFromURL(cubicleNumber) {
    let miniForm = document.getElementById("miniForm");
    if (!miniForm) return;

    miniForm.style.display = "block";
    fetchCubicleData(cubicleNumber);
}

// Function to fetch cubicle details
function fetchCubicleData(cubicleNumber) {
    fetch(`view_data.php?cubicle=${encodeURIComponent(cubicleNumber)}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("miniCubicleNumber").innerText = cubicleNumber;
            document.getElementById("miniCpuSr").innerText = data.cpu_sr || "N/A";
            document.getElementById("miniMonitor1").innerText = data.monitor1_sr || "N/A";
            document.getElementById("miniMonitor2").innerText = data.monitor2_sr || "N/A";
            document.getElementById("miniCisco").innerText = data.cisco_sr || "N/A";
        })
        .catch(error => console.error("Error fetching cubicle details:", error));
}

// Function to close the mini form and reset URL
function closeMiniForm() {
    document.getElementById("miniForm").style.display = "none";
    history.pushState({}, "", window.location.pathname); // Remove cubicle from URL
}
function openForm(buttonValue) {
    let button = document.querySelector(`button[value="${buttonValue}"]`);

    // Check if button contains "✔" (occupied), prevent opening the form
    if (button && button.innerText.trim() === "✔") {
        return; // Do nothing
    }

    // Show form for available cubicles
    document.getElementById('buttonValue').value = buttonValue;
    document.getElementById('submitForm').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
}

// Close the form without submitting
function closeForm() {
    document.getElementById('submitForm').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
}