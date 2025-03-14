fetch('18f_cubicles/rightMidDiv.html')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('hey').appendChild(container);

        const buttons = container.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonValue = this.value;
                openForm(buttonValue);
            });
        });
    });

fetch('18f_cubicles/rightTop.html')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('top').appendChild(container);

        const buttons = container.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonValue = this.value;
                openForm(buttonValue);
            });
        });
    });

fetch('18f_cubicles/middleLeft.html')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('midLeft').appendChild(container);

        const buttons = container.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonValue = this.value;
                openForm(buttonValue);
            });
        });
    });


fetch('18f_cubicles/button.html')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('leftDiv').appendChild(container);

        const buttons = container.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonValue = this.value;
                openForm(buttonValue);
            });
        });
    });

fetch('18f_cubicles/middleBot.html')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('midDiv').appendChild(container);

        const buttons = container.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonValue = this.value;
                openForm(buttonValue);
            });
        });
    });

fetch('18f_cubicles/rightBot.html')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('rightDiv').appendChild(container);

        const buttons = container.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const buttonValue = this.value;
                openForm(buttonValue);
            });
        });
    });


fetch('saveData.php')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('formed').appendChild(container);
    });

fetch('miniForm.php')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('miniForm').appendChild(container);
    });

fetch('editForm.php')
    .then(response => response.text())
    .then(data => {
        const container = document.createElement('div');
        container.innerHTML = data;
        document.getElementById('editForm').appendChild(container);
    });


function toggleLegend() {
        var legend = document.getElementById("legendContent");
        legend.style.display = (legend.style.display === "none" || legend.style.display === "") ? "block" : "none";
    }

function toggleFloor() {
        var legend = document.getElementById("floorContent");
        legend.style.display = (legend.style.display === "none" || legend.style.display === "") ? "block" : "none";
    }
function toggleActions() {
        var legend = document.getElementById("actionContent");
        legend.style.display = (legend.style.display === "none" || legend.style.display === "") ? "block" : "none";
    }
document.addEventListener("click", function (event) {
    const details = document.querySelector("details");
    if (details && details.hasAttribute("open") && !details.contains(event.target)) {
        details.removeAttribute("open");
    }
});