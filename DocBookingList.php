<?php 
include_once('conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Doctor's Dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <style>
        /* Style for buttons */
        button {
            background-color: rgba(113, 99, 186, 255);
            color: #fff;
            padding: 7px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            gap: 3px;
            right: 0;
        }

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
    <script>
        function editBooking(BookingId) {
            window.location.href = 'Edit_booking.php?Booking_id=' + BookingId;
        }

        function refreshPage() {
            window.location.href = window.location.pathname; // Refresh without any query parameters
        }
    </script>
</head>
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
            <?php echo $_SESSION['sessionUsername']; ?>
        </div>
    </div>

    <form method="GET" action="">
        <input type="text" name="search_query" placeholder="Search by Patient name or Status" value="<?php echo isset($_GET['search_query']) ? $_GET['search_query'] : ''; ?>">
        <button type="submit" name="search">Search</button>
        <button type="button" onclick="refreshPage()">Refresh</button>
    </form> 

    <table id="bookingsTable">
        <tr>
            <th>#</th>
            <th>Patient Name</th>
            <th>Date Booked</th>
            <th>Time Booked</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        // Initialize $result
        $result = null;

        // Check if the search form is submitted
        if (isset($_GET['search'])) {
            // Get the search query from the form
            $search_query = $_GET['search_query'];
            
            // Fetch and display patient records from the database based on the search query
            $sql = "SELECT * FROM patient_booking 
                    INNER JOIN patients_table ON patient_booking.Patient_id = patients_table.Patient_id 
                    WHERE patient_booking.Doc_id = '" . $_SESSION['sessionId'] . "' 
                    AND (patients_table.Patient_name LIKE '%" . $search_query . "%' OR patient_booking.Booking_status LIKE '%" . $search_query . "%')";
           
            $result = $link->query($sql);
        } else {
            // Fetch all patient records if no search query is provided
            $sql = "SELECT * FROM patient_booking 
                    INNER JOIN patients_table ON patient_booking.Patient_id = patients_table.Patient_id 
                    WHERE patient_booking.Doc_id = '" . $_SESSION['sessionId'] . "'";
            $result = $link->query($sql);
        }

        // Display the results
        $count = 0;
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $count++;
                echo "<tr>";
                echo "<td>" . $count . "</td>";
                echo "<td>" . $row["Patient_name"] . "</td>";
                echo "<td>" . $row["Booking_date"] . "</td>";
                echo "<td>" . $row["Booking_time"] . "</td>";
                echo "<td>" . $row["Booking_status"] . "</td>";
                echo "<td><button onclick=\"editBooking('{$row['Booking_id']}')\">Update</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
