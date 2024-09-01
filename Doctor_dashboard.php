<?php 
include_once('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Doctor's Dashboard </title>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
      <style>

        /* Style for order table */
#bookingsTable {
    width: 98%;
    
    margin-top: 20px;
}

/* Style for table headers */
#bookingsTable th {
    background-color: rgba(113, 99, 186, 255);
    color: #fff;
    padding: 10px;
}

/* Style for table cells */
#bookingsTable td {
    border: 1px solid #ddd;
    padding: 8px;
}
      </style>


    </head>
    <script>
    
    function editBooking(BookingId) {
        // Redirect to a PHP script that handles the edit operation
        window.location.href = 'Edit_booking.php?Booking_id=' + BookingId;
    }
</script>
    <body>
    <?php include('Doctors_sidemenu.php');?>

        <div class="main--content">
         <div class="header--wrapper">
        <div class="header--title">
                <a href="#">
                <img src="../Savannah-icon.png">
            <br>
                  <span>Savannah Hospital</span>
                </a>
            
            <h2>Doctor's Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
            
                <input type="text" placeholder="search here" />
            </div>
            <img src="user.jpg" alt="" />
            <?php session_start(); echo  $_SESSION['sessionUsername']; ?>
        </div>
         </div>
         <div class="card--container">
            <div class="main-cards">
         <div class="cards">
                    <div class="card-inner">
                        <h3>VIEW PRESCRIPTIONS</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="DocPrescription_report.php">Visit</a></button>
                </div>   
                <div class="cards">
                    <div class="card-inner">
                        <h3>NEW PRESCRIPTION</h3>
                    </div>
                    <button><a href="AddNewPrescription.php">Visit</a></button>
                </div>
                
                
        </div>
        <hr />
        <table id="bookingsTable" >
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Date Booked</th>
                <th>Time Booked</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php
                
                 // Fetch and display patient records from the database
        $result = $link->query("SELECT * FROM patient_booking INNER JOIN patients_table ON patient_booking.Patient_id = patients_table.Patient_id WHERE patient_booking.Doc_id = '".$_SESSION['sessionId']."'  AND patient_booking.Booking_status = 'queued';");
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $count++;
            echo "<tr>";
            echo "<td>" . $count . "</td>";
          echo "<td>" . $row["Patient_name"] . "</td>";
          echo "<td>" . $row["Booking_date"] . "</td>";
          echo "<td>" . $row["Booking_time"] . "</td>";
          echo "<td>" . $row["Booking_status"] . "</td>";
            echo "<td><button onclick=\"editBooking('{$row['Booking_id']}')\">Update</button>";
            echo "</tr>";
        }

            ?>
            <tr>
                <td></td>
            </tr>
        </table>
    </body>
</html>