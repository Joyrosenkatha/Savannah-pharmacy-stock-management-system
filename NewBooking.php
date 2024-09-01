<?php 
//include statement is used to insert the content of one PHP file into another PHP file before the server executes it.
session_start();//starts a new session and stores user information across pages
    //establishes a connection to the database using the function mysqli_connect with the following parameters
$link = mysqli_connect("localhost", "joynkatha", "nkatha", "hospital_pharmacy_stock_management_system_database");

    //To check if database connection was successful
    if (!$link) {//checks if connect link is false
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    

    //statement checks if the form has been submitted.
    //Post variable used to collect values of the input field
    if(isset($_POST['submit'])) {
        
        //the lines retrieve the values from the form fields sent via the POST request and assign them to corresponding PHP variables.
        $Doc_id = $_POST['Doc_id'];
        $Patient_id = $_POST['Patient_id'];
        $Booking_status = $_POST['Booking_status'];
        $Booking_date = $_POST['Booking_date'];   
        $Booking_time = $_POST['Booking_time'];
       
       
    // Validate the date and time
    $date_valid = DateTime::createFromFormat('Y-m-d', $Booking_date) !== false;
    $time_valid = DateTime::createFromFormat('H:i', $Booking_time) !== false;

    // Combine date and time to check if it is not in the past
    if ($date_valid && $time_valid) {
        $Booking_datetime = $Booking_date . ' ' . $Booking_time . ':00'; // Adding seconds to match datetime format
        $currentDateTime = date('Y-m-d H:i:s');

        if ($Booking_datetime >= $currentDateTime) {
            $sql = "INSERT INTO patient_booking (Doc_id, Patient_id, Booking_status, Booking_date, Booking_time)
                    VALUES ('$Doc_id', '$Patient_id', '$Booking_status', '$Booking_date', '$Booking_time')";
            
            if ($link->query($sql) === TRUE) {
                echo "Record added successfully";
                header("Location: NewBooking.php?message=Record added successfully");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        } else {
            echo "Booking date and time must be in the future.";
            header("Location: NewBooking.php?message=Booking date and time must be in the future.");
                exit();
        }
    } else {
        echo "Invalid date or time format.";
        header("Location: NewBooking.php?message=Invalid date or time format.");
                exit();
        
    }
}

include('healthinfo_sidemenu.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Add New Booking </title>
        <link rel="stylesheet" href="style.css" />
       
    
    </head>
    <body>
<style>
        .button-container {
            display: flex;
            justify-content: 25%;
            margin-top: 20px;
        }
        .button-container button, .button-container a {
            margin: 0 10px;
            background-color: rgba(113, 99, 186, 255);
            color: #fff;
            padding: 7px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        </style>

        <div class="main--content">
         <div class="header--wrapper">
        <div class="header--title">
                <a href="#">
                <img src="../Savannah-icon.png">
                <br>
                  <span>Savannah Hospital</span>
                </a>
            
            <h2>Health Information Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                <input type="text" placeholder="search here" />
            </div>
            
            <img src="user.jpg" alt="" />
            <!--outputs the value stored in the $_SESSION['sessionUsername'] session variable, displays logged in user-->
            <?php  echo  $_SESSION['sessionUsername']; ?>
        </div>
         </div> 
         <!--table--container acts as a container for the table that will display the patient records.--> 
         <div>
        <h3 class="main--title">New Booking</h3>
        <form name="Booking_form" method="POST" action="NewBooking.php">
            <table>
                <tr>
                    <td><label for="Doc_id">Doctor Id</label></td>
                    <td>
                        <select id="Doc_id" name="Doc_id"  required>
                            <option value="" selected >--Select Doctor</option>
                            <?php

                             // Fetch and display doctors records from the database
                                $result = $link->query("SELECT * FROM users_table WHERE user_role ='Doctor' ");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["User_id"] . "'>" . $row["Username"] . "</option>";                                    
                                }

                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="Patient_id">Patient</label></td>
                    <td>
                        <select id="Patient_id" name="Patient_id" required>
                            <option value="" selected >--Select Patient</option>
                            <?php

                             // Fetch and display doctors records from the database
                                $result = $link->query("SELECT * FROM patients_table");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["Patient_id"] . "'>" . $row["Patient_name"] . "</option>";                                    
                                }

                            ?>

                        </select>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             </td>
                </tr>                
                <tr>
                    <td><label for="Booking_status">Booking Status</label></td>
                    <td>
                        <select  id="Booking_status" name="Booking_status"  required>
                                <option value="">--Select--</option>
                                <option value="Queued">Queued</option>
                                <option value="Seen" disabled > Seen </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="Booking_date">Booking date</label></td>
                    <td><input type="text" id="Booking_date" name="Booking_date" placeholder="yyyy-mm-dd" required></td>
                </tr>
                <tr>
                    <td><label for="Booking_time">Booking time</label></td>
                    <td><input type="text" id="Booking_time" name="Booking_time" placeholder="hh:mm" required></td>
                </tr>
                
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>

            <div>
                <?php 
                if(isset($_GET['message'])){
                    echo $_GET['message'];
                }
                
                ?>
            </div>
                    <button><a href="Health_information_dashboard.php">Go Back</a></button>
                    
       
                    </form>
    </body>
</html>