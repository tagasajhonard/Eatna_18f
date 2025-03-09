<?php
// Database connection parameters
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "sagility";  // Replace with the database you want to backup

// File name for the backup file
$backupFile = 'backup_' . $dbname . '_' . date('Y-m-d_H-i-s') . '.sql';

// Command to run mysqldump to create the backup for the entire database
$command = "C:\\xampp\\mysql\\bin\\mysqldump --opt --host=$servername --user=$username --password=$password $dbname > $backupFile";

// Execute the command
exec($command, $output, $return_var);

// Check if mysqldump command ran successfully
if ($return_var === 0) {
    // Set the appropriate headers to force download
    header('Content-Type: application/sql');
    header('Content-Disposition: attachment; filename="' . $backupFile . '"');
    header('Content-Length: ' . filesize($backupFile));
    
    // Read the file and send it to the user
    readfile($backupFile);
    
    // Optional: delete the backup file after download
    unlink($backupFile);
    exit;
} else {
    // If there was an error with mysqldump
    echo "Error executing mysqldump: Return code: $return_var";
}
?>
