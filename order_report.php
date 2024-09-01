<D html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAVANNAH HOSPITAL | Order Records </title>
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
    <h2>Order Report</h2>
    
    <form method="GET">
        <div>
            <label for="searchOrderId">Search by Order Id:</label>
            <input type="text" id="searchOrderId" name="searchOrderId">
        </div>
        <div>
            <label for="startDate">Start Date:</label>
            <input type="text" id="startDate" name="startDate"placeholder="YYYY-MM-DD">
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
                        <th>Medicine Id</th>
                        <th>Quantity ordered</th>
                        <th>Supplier Id</th>
                        <th>Supplier Email</th>
                        <th>Date Ordered</th>
                        <th>Quantity received</th>
                        <th>Unit price</th>
                        <th>Total Cost</th>
                        <th>Order status</th>

                        
        </tr>
    </thead>
    <tbody>
    <?php
include('conn.php');

// Build the SQL query based on the search criteria
$sql = "SELECT orders_table.*, medicine_table.Med_name, supplier_table.Supplier_name 
        FROM orders_table
        JOIN medicine_table ON orders_table.Med_id = medicine_table.Med_id
        JOIN supplier_table ON orders_table.Supplier_id = supplier_table.Supplier_id
        WHERE 1=1"; 

if (isset($_GET['searchOrderId']) && !empty($_GET['searchOrderId'])) {
    $clean_searchOrderId = $_GET['searchOrderId'];
    $sql .= " AND Order_id = $clean_searchOrderId ";
}


    if (isset($_GET['startDate']) && !empty($_GET['endDate'])) {
        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        $sql .= " AND Date_ordered BETWEEN '$startDate' AND '$endDate'";
    }

if (isset($_GET['month']) && !empty($_GET['month']) && isset($_GET['year']) && !empty($_GET['year'])) {
    $month = $_GET['month'];
        $year = $_GET['year'];
        $sql .= " AND MONTH(Date_ordered) = $month AND YEAR(Date_added) = $year";
    }
    if (isset($_GET['monthRangeFrom']) && isset($_GET['yearRangeFrom']) && isset($_GET['monthRangeTo']) && isset($_GET['yearRangeTo']) &&
    !empty($_GET['monthRangeFrom']) && !empty($_GET['yearRangeFrom']) && !empty($_GET['monthRangeTo']) && !empty($_GET['yearRangeTo'])) {
        $monthRangeFrom = $_GET['monthRangeFrom'];
        $yearRangeFrom = $_GET['yearRangeFrom'];
        $monthRangeTo = $_GET['monthRangeTo'];
        $yearRangeTo = $_GET['yearRangeTo'];
    $sql .= " AND ((YEAR(Date_ordered) = $yearRangeFrom AND MONTH(Date_ordered) >= $monthRangeFrom) OR (YEAR(Date_ordered) = $yearRangeTo AND MONTH(Date_ordered) <= $monthRangeTo))";
}
if (isset($_GET['year']) && !empty($_GET['year'])) {
    $year = ($_GET['year']);
    $sql .= " AND YEAR(Date_ordered) = $year";
}


// Check if any search criteria were provided
if (strpos($sql, 'WHERE') !== false) {
    // At least one search criteria was provided, execute the query
    $result = $link->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                //to calculate total cost of orders
        $Total_cost = $row["Quantity_received"] * $row["Unit_price"];
                echo "<tr>";
                echo "<td>" . $row["Order_id"] . "</td>";
                echo "<td>" . $row["Med_name"] . "</td>";
                echo "<td>" . $row["Quantity_ordered"] . "</td>";
                echo "<td>" . $row["Supplier_name"] . "</td>";
                echo "<td>" . $row["Supplier_email"] . "</td>";
                echo "<td>" . $row["Date_ordered"] . "</td>";
                echo "<td>" . $row["Quantity_received"] . "</td>";
                echo "<td>" . $row["Unit_price"] . "</td>";
                echo "<td>" . $Total_cost. "</td>";
                echo "<td>" . $row["Order_status"] . "</td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No Order record found.</td></tr>";
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
    var printableContent = "<html><head><title>Savannah Hospital Order Report</title></head><body>";
    printableContent += "<img src='../Savannah-logo.png' alt='Hospital Logo'>";
    printableContent += "<h2>Savannah Hospital Order Report</h2>";
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