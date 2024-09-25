<?php
function generateRandomString($length) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

$conn = mysqli_connect("localhost", "root", "", "web");

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Taking all values from the form data(input)
$Name = $_POST['Name'] ?? '';
$Train_Name = $_POST['Train_Name'] ?? '';
$Class = $_POST['Class'] ?? '';
$Date_of_travel = $_POST['Date_of_travel'] ?? '';
$From_place = $_POST['From_place'] ?? '';
$To_place = $_POST['To_place'] ?? '';

// Generating unique PNR_number and ticket_number using generateRandomString() function
$Pnr_number = generateRandomString(8);
$ticketNumber = generateRandomString(8);

// Performing insert query execution
$sql = "INSERT INTO train_booking (Name, Train_Name, Class, Date_of_travel, From_place, To_place, Pnr_number, ticketNumber)
        VALUES ('$Name', '$Train_Name', '$Class', '$Date_of_travel', '$From_place', '$To_place', '$Pnr_number', '$ticketNumber')";

if (mysqli_query($conn, $sql)) {
    echo "<h3>Reservation is successful</h3>";

    // Display generated PNR number and ticket number to the user
    echo "<p>PNR Number: $Pnr_number</p>";
    echo "<p>Ticket Number: $ticketNumber</p>";
} else {
    echo "ERROR: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
