document.addEventListener("DOMContentLoaded", function() {
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
                    button.addEventListener("click", function(event) {
                        showMiniForm(event, cubicle);
                    });
                }
            });
        })
        .catch(error => console.error("Error fetching cubicle data:", error));

});

function showMiniForm(event, cubicleNumber) {
    let miniForm = document.getElementById("miniForm");

    // Check if miniForm exists
    if (!miniForm) return;

    miniForm.style.top = event.clientY + "px";
    miniForm.style.left = event.clientX + "px";
    miniForm.style.display = "block";

    // Set actions for View and Edit buttons
    document.getElementById("viewBtn").onclick = function() {
        let url = `view_data.php?cubicleNumber=${encodeURIComponent(cubicleNumber)}`;
        window.location.href = url;
    };


    document.getElementById("editBtn").onclick = function() {
        window.location.href = `edit_data.php?cubicle=${cubicleNumber}`;
    };
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