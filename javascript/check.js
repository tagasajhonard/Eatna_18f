// document.addEventListener("DOMContentLoaded", function () {
//     fetch("get_cubicle_data.php")
//         .then(response => response.json())
//         .then(occupiedCubicles => {
//             occupiedCubicles.forEach(cubicle => {
//                 let button = document.querySelector(`button[value="${cubicle}"]`);
//                 if (button) {
//                     button.innerText = "✔";
//                     button.style.backgroundColor = "#f39c12";
//                     button.style.color = "#fff";

//                     // Add click event only if cubicle has data
//                     button.addEventListener("click", function (event) {
//                         updateURL(cubicle);
//                         showMiniForm(event, cubicle);
//                     });
//                 }
//             });
//         })
//         .catch(error => console.error("Error fetching cubicle data:", error));

//     const urlParams = new URLSearchParams(window.location.search);
//     const cubicleFromURL = urlParams.get("cubicle");
//     if (cubicleFromURL) {
//         showMiniFormFromURL(cubicleFromURL);
//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    // Global variable to store the active floor
    let activeFloor = null;

    const floorButtons = document.querySelectorAll(".floor-btn");
    const selectMessage = document.getElementById("selectMessage");
    const miniForm = document.getElementById("miniForm");

    // Floor button click handler
    floorButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Set the active floor
            activeFloor = this.getAttribute("data-floor");

            // Update the URL with only the floor parameter (optional)
            const url = new URL(window.location);
            url.searchParams.set("floor", activeFloor);
            url.searchParams.delete("cubicle"); // clear cubicle state when switching floors
            window.history.pushState({}, "", url);
            console.log("Current URL parameters:", window.location.search);

            // Hide the mini form and any previous messages
            if (miniForm) {
                miniForm.style.display = "none";
            }
            if (selectMessage) {
                selectMessage.style.display = "none";
            }

            // Hide all floor tables and then show only the active floor's table
            document.querySelectorAll("table").forEach(table => {
                table.style.display = "none";
            });
            const selectedTable = document.getElementById(`table_${activeFloor}`);
            if (selectedTable) {
                selectedTable.style.display = "table";
            }

            // Highlight the active floor button
            floorButtons.forEach(btn => btn.classList.remove("active-floor"));
            this.classList.add("active-floor");

            // Clear previous check marks in the active table
            if (selectedTable) {
                selectedTable.querySelectorAll('.cubicle-btn').forEach(cubicleBtn => {
                    // Reset to original content if stored in a data attribute
                    cubicleBtn.innerText = cubicleBtn.getAttribute("data-original") || cubicleBtn.innerText;
                    cubicleBtn.style.backgroundColor = "";
                    cubicleBtn.style.color = "";
                });
            }

            // Fetch data for the active floor using the common endpoint.
            // The PHP code will choose the table based on the floor parameter.
            fetch(`get_cubicle_data.php?floor=${activeFloor}`)
                .then(response => response.json())
                .then(occupiedCubicles => {
                    console.log("Occupied Cubicles:", occupiedCubicles);
                    // Update only the active table's buttons
                    occupiedCubicles.forEach(cubicle => {
                        let btn = selectedTable.querySelector(`button.cubicle-btn[value="${cubicle.toString()}"]`);
                        if (btn) {
                            btn.innerText = "✔";
                            btn.style.backgroundColor = "#f39c12";
                            btn.style.color = "#fff";
                        } else {
                            console.warn(`Button for cubicle ${cubicle} not found in table_${activeFloor}`);
                        }
                    });
                })
                .catch(error => console.error("Error fetching cubicle data:", error));
        });
    });

    // Use event delegation for cubicle button clicks.
    // Each button should have the class "cubicle-btn" and a data-floor attribute.
    document.addEventListener("click", function (event) {
        if (event.target.matches('.cubicle-btn')) {
            // Optionally, verify that this cubicle belongs to the active floor.
            const btnFloor = event.target.getAttribute("data-floor");
            if (btnFloor !== activeFloor) {
                // If for some reason the button isn't for the active floor, ignore it.
                return;
            }
            const cubicle = event.target.getAttribute("value");
            // Update mini form content based on cubicle and active floor
            updateURL(cubicle); // if needed
            showMiniForm(event, cubicle);
        }
    });

    // Optionally, if you want to load the floor from the URL on page load:
    const urlParams = new URLSearchParams(window.location.search);
    const floorFromURL = urlParams.get("floor");
    if (floorFromURL) {
        activeFloor = floorFromURL;
        const selectedTable = document.getElementById(`table_${activeFloor}`);
        if (selectedTable) {
            selectedTable.style.display = "table";
            if (selectMessage) {
                selectMessage.style.display = "none";
            }
            const activeButton = document.querySelector(`.floor-btn[data-floor="${activeFloor}"]`);
            if (activeButton) {
                activeButton.classList.add("active-floor");
            }
        }
    }
});








function updateURL(cubicleNumber) {
    const newURL = `${window.location.pathname}?cubicle=${cubicleNumber}`;
    history.pushState({ cubicle: cubicleNumber }, "", newURL);
}

function showMiniForm(event, cubicleNumber) {
    let miniForm = document.getElementById("miniForm");
    if (!miniForm) return;

    miniForm.style.display = "block";


    let formWidth = miniForm.offsetWidth;
    let formHeight = miniForm.offsetHeight;

    let posX = event.clientX;
    let posY = event.clientY - formHeight / 2;

    miniForm.style.top = `${posY}px`;
    miniForm.style.left = `${posX}px`;

    fetchCubicleData(cubicleNumber);
}

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

function closeMiniForm() {
    document.getElementById("miniForm").style.display = "none";
    history.pushState({}, "", window.location.pathname);
}
function openForm(buttonValue) {
    let button = document.querySelector(`button[value="${buttonValue}"]`);

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