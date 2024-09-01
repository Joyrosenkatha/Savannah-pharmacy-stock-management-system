<?php
$link = mysqli_connect("localhost", "joynkatha", "nkatha", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>