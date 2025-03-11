
$(document).ready(function () {
    $('#switchBtn').on('click', function () {
        let unitType = $('#unitType').val(); // What to switch
        let cubicle1 = $('#unitSelect1').val();
        let cubicle2 = $('#unitSelect2').val();

        // Check if all required fields are selected
        if (!unitType || !cubicle1 || !cubicle2) {
            alert('Please select both cubicles and what to switch.');
            return;
        }

        // AJAX Request to send data to PHP
        $.ajax({
            url: 'switch_cubicles.php',
            method: 'POST',
            data: {
                unitType: unitType,
                cubicle1: cubicle1,
                cubicle2: cubicle2
            },
            success: function (response) {
                alert(response); // Show success or error message
                location.reload(); // Refresh the page to reflect changes
            },
            error: function () {
                alert('An error occurred while switching cubicles.');
            }
        });
    });
});

