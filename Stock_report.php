<D html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <title>SAVANNAH HOSPITAL | Stock List </title>
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
    <h2>Stock Reports</h2>
    
    <form method="GET">
        <tr>
            <td><label for="searchStockId">Search by Stock Id:</label></td>
            <td><input type="text" id="searchStockId" name="searchStockId"></td>
            </tr>
        <tr>
        <td><label for="startDate">Start Date:</label></td>
        <td><input type="text" id="startDate" name="startDate" placeholder="YYYY-MM-DD"></td>
        <td><label for="endDate">End Date:</label></td>
        <td><input type="text" id="endDate" name="endDate" placeholder="YYYY-MM-DD"></td>
        </tr>
        <tr>
            <td></td><label for="month">Month:</label></td>
            <td><select id="month" name="month">
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
            </select></td>
            <td><label for="year">Year:</label></td>
            <td><input type="number" id="year" name="year" min="1900" max="2099" step="1" value="2024"></td>
            </tr>
        <tr>
        <td><label for="monthRangeFrom">Month Range (From):</label></td>
        <td><select id="monthRangeFrom" name="monthRangeFrom">
            <option value="">Select Month</option>
                <?php
                foreach ($months as $monthNum => $monthName) {
                    echo "<option value='$monthNum'>$monthName</option>";
                }
                ?>
            </select></td>
            <td><label for="yearRangeFrom">Year (From):</label></td>
            <td><input type="number" id="yearRangeFrom" name="yearRangeFrom" min="1900" max="2099" step="1" value="2022"></td>
            </tr>
        <tr>
        <td><label for="monthRangeTo">Month Range (To):</label></td>
        <td><select id="monthRangeTo" name="monthRangeTo"></td>
            <option value="">Select Month</option>
            <?php
            foreach ($months as $monthNum => $monthName) {
                echo "<option value='$monthNum'>$monthName</option>";
            }
            ?>
        </select></td>
        <td><label for="yearRangeTo">Year (To):</label></td>
        <td><input type="number" id="yearRangeTo" name="yearRangeTo" min="1900" max="2099" step="1" value="2022"></td>
        </tr>
    <div>
            <label for="expiredOnly">Expired Only:</label>
            <input type="checkbox" id="expiredOnly" name="expiredOnly">
        </div>
        <div>
    <label for="inStock">In Stock:</label>
    <input type="checkbox" id="inStock" name="inStock">
</div>
<div>
    <label for="outOfStock">Out of Stock:</label>
    <input type="checkbox" id="outOfStock" name="outOfStock">
</div>
<div>
        <button type="submit">Search</button>
        <button type="submit" name="search">Refresh</button>
        <br>
        <br>
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
                        <th>Medicine Id</th>
                        <th>Quantity in Stock</th>
                        <th>Expiry Date</th>
                        <th>Supplier Id</th>
                        <th>Date Acquired</th>
                        <th>Status</th>
                        <th>Days to Expiry</th>
                        
        </tr>
    </thead>
    <tbody>
    <?php
include('conn.php');

// Build the SQL query based on the search criteria
$sql = "SELECT st.*, m.Med_name, s.Supplier_name FROM stocks_table st 
                JOIN medicine_table m ON st.Med_id = m.Med_id 
                JOIN supplier_table s ON st.Supplier_id = s.Supplier_id 
                WHERE 1=1"; 

if (isset($_GET['searchStockId']) && !empty($_GET['searchStockId'])) {
    $clean_searchStockId = $_GET['searchStockId'];
        $sql .= " AND Stock_id = $clean_searchStockId";
    } 


if (isset($_GET['startDate']) && !empty($_GET['endDate']) && isset($_GET['startDate']) && !empty($_GET['endDate'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
            $sql .= " AND Date_acquired BETWEEN '$startDate' AND '$endDate'";
        } 

        if (isset($_GET['month']) && !empty($_GET['month']) && isset($_GET['year']) && !empty($_GET['year'])) {
            $month = $_GET['month'];
                $year = $_GET['year'];
    $sql .= " AND MONTH(Date_acquired) = $month AND YEAR(Date_acquired) = $year";
}

if (isset($_GET['monthRangeFrom']) && isset($_GET['yearRangeFrom']) && isset($_GET['monthRangeTo']) && isset($_GET['yearRangeTo']) &&
!empty($_GET['monthRangeFrom']) && !empty($_GET['yearRangeFrom']) && !empty($_GET['monthRangeTo']) && !empty($_GET['yearRangeTo'])) {
    $monthRangeFrom = $_GET['monthRangeFrom'];
    $yearRangeFrom = $_GET['yearRangeFrom'];
    $monthRangeTo = $_GET['monthRangeTo'];
    $yearRangeTo = $_GET['yearRangeTo'];
    $sql .= " AND ((YEAR(Date_acquired) = $yearRangeFrom AND MONTH(Date_acquired) >= $monthRangeFrom) OR (YEAR(Date_acquired) = $yearRangeTo AND MONTH(Date_acquired) <= $monthRangeTo))";
}
if (isset($_GET['year']) && !empty($_GET['year'])) {
    $year = ($_GET['year']);
    $sql .= " AND YEAR(Date_acquired) = $year";
}
if (isset($_GET['expiredOnly']) && $_GET['expiredOnly'] === 'on') {
    $currentDate = date('Y-m-d');
    $sql .= " AND Expiry_date < '$currentDate'";
}
if (isset($_GET['inStock']) && !isset($_GET['outOfStock'])) {
    $sql .= " AND `Status` = 'in stock'"; // Only include drugs that are in stock
}

if (isset($_GET['outOfStock']) && !isset($_GET['inStock'])) {
    $sql .= " AND `Status` = 'out of stock'"; // Only include drugs that are out of stock
}



// Check if any search criteria were provided
if (strpos($sql, 'WHERE') !== false) {
    // At least one search criteria was provided, execute the query
    $result = $link->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                //days to expiry calculation
            $datenow = time();
            $expirydate = strtotime($row["Expiry_date"]);
            $date_diff = $expirydate -$datenow;
            $date_diff_in_days =  round($date_diff / (60 * 60 * 24));

            if($date_diff_in_days < 0 ){
                $day_to_expiry = "EXPIRED";
            }else{
                $day_to_expiry = $date_diff_in_days;
            }

                echo "<tr>";
                echo "<td>" . $row["Stock_id"] . "</td>";
                echo "<td>" . $row["Med_name"] . "</td>";
                echo "<td>" . $row["Quantity_in_Stock"] . "</td>";
                echo "<td>" . $row["Expiry_date"] . "</td>";
                echo "<td>" . $row["Supplier_name"] . "</td>";
                echo "<td>" . $row["Date_acquired"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "<td>" . $day_to_expiry . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No Stock details found.</td></tr>";
        }
    } else {
        echo "Error: " . $link->error;
    }
} else {
    // No search criteria were provided
    echo "<tr><td colspan='9'>Please provide at least one search criteria.</td></tr>";
}
// Close MySQL connection
$link->close();
?>


    </tbody>
</table>

<script>
function printOrdersReport() {
    // Create a new window with printable content
    var printableContent = "<html><head><title>Savannah Hospital Stock Report</title></head><body>";
    printableContent += "<img src='../Savannah-logo.png' alt='Hospital Logo'>";
    printableContent += "<h2>Savannah Hospital Stock Report</h2>";
    printableContent += "<table>";
    // Add table header
    printableContent += "<thead>" + document.querySelector("table thead").innerHTML + "</thead>";
    // Add table body
    printableContent += "<tbody>" + document.querySelector("table tbody").innerHTML + "</tbody>";
    printableContent += "</table>";
    printableContent += "</body></html>";

    // Open new window with printable content
    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(printableContent);
    printWindow.document.close();

    // Print the content
    printWindow.print();
}
</script>

 </body>
    </html>