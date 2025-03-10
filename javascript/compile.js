fetch('cubicles/rightMidDiv.html')
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

fetch('cubicles/rightTop.html')
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

fetch('cubicles/middleLeft.html')
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


fetch('cubicles/button.html')
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

fetch('cubicles/middleBot.html')
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

fetch('cubicles/rightBot.html')
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


function toggleLegend() {
        var legend = document.getElementById("legendContent");
        legend.style.display = (legend.style.display === "none" || legend.style.display === "") ? "block" : "none";
    }
    