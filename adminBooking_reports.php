<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVANNAH HOSPITAL | Booking Records</title>
    <style>
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100%;
            height: 50px;
        }
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            color: rgba(113, 99, 186, 255);
        }
        form {
            margin-bottom: 20px;
        }
        form > div {
            margin-bottom: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        select,
        input[type="number"] {
            width: 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-left: 10px;
        }
        select {
            width: 220px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: rgba(113, 99, 186, 255);
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: purple;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left; 
            padding: 8px;
        }
        th {
            background-color: rgba(113, 99, 186, 255);
            color: #fff;
        }
    </style>  
</head>
<body>
<header>
    <div class="logo">
        <img src="../Savannah-logo.png" alt="Hospital Logo">
    </div>
</header>
<h2>Booking Report</h2>

<form method="GET">
    <div>
        <label for="searchBookingId">Search by Booking Id:</label>
        <input type="text" id="searchBookingId" name="searchBookingId">
    </div>
    <div>
        <label for="searchDoctorName">Search by Doctor Name:</label>
        <input type="text" id="searchDoctorName" name="searchDoctorName">
    </div>
    <div>
        <label for="startDate">Start Date:</label>
        <input type="text" id="startDate" name="startDate" placeholder="yyyy-mm-dd">
        <label for="endDate">End Date:</label>
        <input type="text" id="endDate" name="endDate" placeholder="yyyy-mm-dd">
    </div>
    <div>
        <label for="month">Month:</label>
        <select id="month" name="month">
            <option value="">Select Month</option>
            <?php
            $months = [
                1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
                7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
            ];
            foreach ($months as $monthNum => $monthName) {
                echo "<option value='$monthNum'>$monthName</option>";
            }
            ?>
        </select>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?php echo date('Y'); ?>">
    </div>
    <div>
        <label for="monthRangeFrom">Month Range (From):</label>
        <select id="monthRangeFrom" name="monthRangeFrom">
            <option value="">Select Month</option>
            <?php
            foreach ($months as $monthNum => $monthName) {
                echo "<option value='$monthNum'>$monthName</option>";
            }
            ?>
        </select>
        <label for="yearRangeFrom">Year (From):</label>
        <input type="number" id="yearRangeFrom" name="yearRangeFrom" min="1900" max="2099" step="1" value="2022">
    </div>
    <div>
        <label for="monthRangeTo">Month Range (To):</label>
        <select id="monthRangeTo" name="monthRangeTo">
            <option value="">Select Month</option>
            <?php
            foreach ($months as $monthNum => $monthName) {
                echo "<option value='$monthNum'>$monthName</option>";
            }
            ?>
        </select>
        <label for="yearRangeTo">Year (To):</label>
        <input type="number" id="yearRangeTo" name="yearRangeTo" min="1900" max="2099" step="1" value="2022">
    </div>
    <div>
        <button type="submit">Search</button>
        <button type="button" onclick="printBookingsReport()">Print Report</button>
        <br><br>
        <button><a href="Admin_dashboard.php">Go Back</a></button>
    </div>
</form>

<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Doctor Name</th>
            <th>Patient Name</th>
            <th>Status</th>
            <th>Booking Date</th>
            <th>Booking Time</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include('conn.php');

    $errorMsg = '';

    // Adjust SQL query with actual table names
    $sql = "
        SELECT pb.Booking_id, u.Username, p.Patient_name, pb.Booking_status, pb.Booking_date, pb.Booking_time
        FROM patient_booking pb
        JOIN patients_table p ON pb.Patient_id = p.Patient_id
        JOIN users_table u ON pb.Doc_id = u.User_id
        WHERE 1=1
    ";

    if (isset($_GET['searchBookingId']) && !empty($_GET['searchBookingId'])) {
        $clean_searchBookingId = $_GET['searchBookingId'];
        $sql .= " AND Booking_id = $clean_searchBookingId ";
    }

    if (isset($_GET['searchDoctorName']) && !empty($_GET['searchDoctorName'])) {
        $clean_searchDoctorName = $_GET['searchDoctorName'];
        $sql .= " AND Username LIKE '%$clean_searchDoctorName%'";
    }

    if (isset($_GET['startDate']) && !empty($_GET['endDate'])) {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $sql .= " AND Booking_date BETWEEN '$startDate' AND '$endDate'";
    }

    if (isset($_GET['month']) && !empty($_GET['month']) && isset($_GET['year']) && !empty($_GET['year'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
        $sql .= " AND MONTH(Booking_date) = $month AND YEAR(Booking_date) = $year";
    }

    if (isset($_GET['monthRangeFrom']) && isset($_GET['yearRangeFrom']) && isset($_GET['monthRangeTo']) && isset($_GET['yearRangeTo']) &&
        !empty($_GET['monthRangeFrom']) && !empty($_GET['yearRangeFrom']) && !empty($_GET['monthRangeTo']) && !empty($_GET['yearRangeTo'])) {
            $monthRangeFrom = $_GET['monthRangeFrom'];
            $yearRangeFrom = $_GET['yearRangeFrom'];
            $monthRangeTo = $_GET['monthRangeTo'];
            $yearRangeTo = $_GET['yearRangeTo'];
            $sql .= " AND ((YEAR(Booking_date) = $yearRangeFrom AND MONTH(Booking_date) >= $monthRangeFrom) OR (YEAR(Booking_date) = $yearRangeTo AND MONTH(Booking_date) <= $monthRangeTo))";
    }

    $result = $link->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Booking_id"] . "</td>";
                echo "<td>" . $row["Username"] . "</td>";
                echo "<td>" . $row["Patient_name"] . "</td>";
                echo "<td>" . $row["Booking_status"] . "</td>";
                echo "<td>" . $row["Booking_date"] . "</td>";
                echo "<td>" . $row["Booking_time"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No booking records found.</td></tr>";
        }
    } else {
        echo "Error: " . $link->error;
    }

    $link->close();
    ?>
    </tbody>
</table>

<script>
function printBookingsReport() {
    var printableContent = "<html><head><title>Savannah Hospital Booking Report</title></head><body>";
    printableContent += "<img src='../Savannah-logo.png' alt='Hospital Logo'>";
    printableContent += "<h2>Savannah Hospital Booking Report</h2>";
    printableContent += "<table>";
    printableContent += "<thead>" + document.querySelector("table thead").innerHTML + "</thead>";
    printableContent += "<tbody>" + document.querySelector("table tbody").innerHTML + "</tbody>";
    printableContent += "</table>";
    printableContent += "</body></html>";

    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(printableContent);
    printWindow.document.close();

    printWindow.print();
}
</script>

</body>
</html>
