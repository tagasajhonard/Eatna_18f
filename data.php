<link rel="stylesheet" href="css/card.css">

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'connection/connection.php';

if (isset($_POST['submit'])) {

    $id = $_POST["buttonValue"];
    $cpuSerialNumber = $_POST['cpuSerialNumber'];
    $monitor1SerialNumber = $_POST['monitor1SerialNumber'];
    $monitor2SerialNumber = $_POST['monitor2SerialNumber'];
    $ciscoSerialNumber = $_POST['ciscoSerialNumber'];

    $sql = "INSERT INTO eatna_18f(cubicle_number, cpu_sr, monitor1_sr, monitor2_sr, cisco_sr)VALUES('{$id}','{$cpuSerialNumber}','{$monitor1SerialNumber}','{$monitor2SerialNumber}','{$ciscoSerialNumber}')";
    
    if($conn->query($sql) === TRUE){
        echo "<div class='success-card'>
                <p>New record created</p>
                <p id='timer'>Redirecting in 3 seconds...</p>
              </div>
              <script>
                var timeLeft = 3;
                var timerElement = document.getElementById('timer');

                // Function to update the timer text every second
                var countdown = setInterval(function() {
                    timeLeft--;
                    timerElement.textContent = 'Redirecting in ' + timeLeft + ' seconds...';
                    
                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        window.location.href = 'table.php'; 
                    }
                }, 1000);
              </script>";
    } else {
        echo "<div class='error-card'>Error: Could not insert data</div>";
    }
}

?>