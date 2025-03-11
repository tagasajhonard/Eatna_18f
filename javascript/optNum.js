    $(document).ready(function () {
    $('#unitSelect1').on('change', function () {
        let selectedValue = $(this).val();  // Get selected value in Option 1

        // Enable all options in Option 2 first (to reset)
        $('#unitSelect2 option').each(function () {
            $(this).prop('disabled', false).show();

            // Disable the matching option
            if ($(this).val() === selectedValue && selectedValue !== "") {
                $(this).prop('disabled', true).hide();
            }
        });
    });

    $('#unitSelect2').on('change', function () {
        let selectedValue = $(this).val();  // Get selected value in Option 2

        // Enable all options in Option 1 first (to reset)
        $('#unitSelect1 option').each(function () {
            $(this).prop('disabled', false).show();

            // Disable the matching option
            if ($(this).val() === selectedValue && selectedValue !== "") {
                $(this).prop('disabled', true).hide();
            }
        });
    });
});