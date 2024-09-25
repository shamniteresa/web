<?php
$conn = mysqli_connect("localhost", "root", "", "web");

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Taking all 3 values from the form data (input)
    $pnr_number = isset($_POST['Pnr_number']) ? $_POST['Pnr_number'] : '';
    $ticketNumber = isset($_POST['ticketNumber']) ? $_POST['ticketNumber'] : '';
    $captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';

    if (!empty($pnr_number) && !empty($ticketNumber) && !empty($captcha)) {
        // Prepare the SQL statement to check if the PNR number and Ticket number exist in the database
        $checkQuery = "SELECT * FROM train_booking WHERE Pnr_number = ? AND ticketNumber = ?";
        $checkStmt = mysqli_prepare($conn, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, "ss", $pnr_number, $ticketNumber);
        mysqli_stmt_execute($checkStmt);
        $result = mysqli_stmt_get_result($checkStmt);

        // Check if the PNR number and Ticket number exist in the database
        if (mysqli_num_rows($result) > 0) {
            // If both PNR number and Ticket number exist, delete the respective entry
            $deleteQuery = "DELETE FROM train_booking WHERE Pnr_number = ? AND ticketNumber = ?";
            $deleteStmt = mysqli_prepare($conn, $deleteQuery);
            mysqli_stmt_bind_param($deleteStmt, "ss", $pnr_number, $ticketNumber);
            mysqli_stmt_execute($deleteStmt);

            echo "Entry with PNR number '$pnr_number' and Ticket number '$ticketNumber' removed successfully.";
        } else {
            echo "Entry with PNR number '$pnr_number' and Ticket number '$ticketNumber' not found in the database.";
        }
    } else {
        echo "Please provide PNR number, Ticket number, and Captcha.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
mysqli_close($conn);
?>
