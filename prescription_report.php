<D html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    
    <title>SAVANNAH HOSPITAL | Prescription List </title>
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
            font_family: Arial, sans-serif;
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
        select{
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
            padding: 20px;
        }
        th {
            background-color: rgba(113, 99, 186, 255);
        }

    </style>  
 </head>
 <body>
 <header>
        <div class="logo">
            <img src="../Savannah-logo.png" alt="Hospital Logo">
        </div>
    </header>
    <h2>Prescription Report</h2>
    
    <form method="GET">
        <div>
            <label for="searchPrescriptionId">Search by prescription Id:</label>
            <input type="text" id="searchPrescriptionId" name="searchPrescriptionId">
        </div>
        <div>
        <label for="doctorName">Doctor's Name:</label>
        <input type="text" id="doctorName" name="doctorName">
    </div>
        <div>
            <label for="startDate">Start Date:</label>
            <input type="text" id="startDate" name="startDate" placeholder="YYYY-MM-DD">
            <label for="endDate">End Date:</label>
            <input type="text" id="endDate" name="endDate" placeholder="YYYY-MM-DD">
        </div>
        <div>
            <label for="month">Month:</label>
            <select id="month" name="month">
                <option value="">Select Month</option>
                <?php
                $months = [
                    1 => 'January', 2 =>'February', 3 =>'March', 4 =>'April', 5 =>'May', 6 =>'June',
                    7 =>'July', 8 =>'August', 9 =>'September', 10 =>'October', 11 =>'November', 12 =>'December'
                ];
                foreach ($months as $monthNum => $monthName) {
                    echo "<option value='$monthNum'>$monthName</option>";
                }
                ?>
            </select>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="2024">
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
        <button onclick="printOrdersReport()">Print Report</button>
        <br>
        <br>
        <button><a href="Admin_dashboard.php">Go Back</a></button>
    </div>
   
</form>
<table>
    <thead>
        <tr>
        <th>ID</th>
                        <th>Patient Name</th>
                        <th>Medicine Name</th>
                        <th>Prescription date</th>
                        <th>Dosage</th>
                        <th>Doctor's Name</th>
                        <th>Status</th>
                        
                        
        </tr>
    </thead>
    <tbody>
    <?php
$link = mysqli_connect("localhost", "joynkatha", "nkatha", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT p.Prescription_id, pt.Patient_name, mt.Med_name, p.Prescription_date, p.Dosage, p.Doc_name, p.Status 
        FROM prescriptions_table p 
        JOIN patients_table pt ON p.Patient_id = pt.Patient_id 
        JOIN medicine_table mt ON p.Med_id = mt.Med_id 
        WHERE 1=1";

if (isset($_GET['searchPrescriptionId']) && !empty($_GET['searchPrescriptionId'])) {
    $searchPrescriptionId = $_GET['searchPrescriptionId'];
    $sql .= " AND p.Prescription_id = $searchPrescriptionId";
} 
if (isset($_GET['doctorName']) && !empty($_GET['doctorName'])) {
    $doctorName = $_GET['doctorName'];
    $sql .= " AND p.Doc_name LIKE '%$doctorName%'";
}
if (isset($_GET['startDate']) && !empty($_GET['endDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $sql .= " AND p.Prescription_date BETWEEN '$startDate' AND '$endDate'";
} 

if (isset($_GET['month']) && !empty($_GET['month']) && isset($_GET['year']) && !empty($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
    $sql .= " AND MONTH(p.Prescription_date) = $month AND YEAR(p.Prescription_date) = $year";
}

if (isset($_GET['monthRangeFrom']) && isset($_GET['yearRangeFrom']) && isset($_GET['monthRangeTo']) && isset($_GET['yearRangeTo']) &&
    !empty($_GET['monthRangeFrom']) && !empty($_GET['yearRangeFrom']) && !empty($_GET['monthRangeTo']) && !empty($_GET['yearRangeTo'])) {
    $monthRangeFrom = $_GET['monthRangeFrom'];
    $yearRangeFrom = $_GET['yearRangeFrom'];
    $monthRangeTo = $_GET['monthRangeTo'];
    $yearRangeTo = $_GET['yearRangeTo'];
    $sql .= " AND ((YEAR(p.Prescription_date) = $yearRangeFrom AND MONTH(p.Prescription_date) >= $monthRangeFrom) 
              OR (YEAR(p.Prescription_date) = $yearRangeTo AND MONTH(p.Prescription_date) <= $monthRangeTo))";
}

if (isset($_GET['year']) && !empty($_GET['year'])){
    $year = ($_GET['year']);
    $sql .= " AND YEAR(p.Prescription_date) = $year";
}

// Execute the query
$result = $link->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Prescription_id"] . "</td>";
            echo "<td>" . $row["Patient_name"] . "</td>";
            echo "<td>" . $row["Med_name"] . "</td>";
            echo "<td>" . $row["Prescription_date"] . "</td>";
            echo "<td>" . $row["Dosage"] . "</td>";
            echo "<td>" . $row["Doc_name"] . "</td>";
            echo "<td>" . $row["Status"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
} else {
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}

// Close the connection
mysqli_close($link);
?>
</tbody>
</table>
</body>
</html>
