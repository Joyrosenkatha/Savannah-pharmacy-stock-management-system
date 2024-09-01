<?php
// Include database connection and authentication files
include('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savanna | Medicine </title>
</head>
<body>
    <style>
        /* Style for form container */
        * {
            margin: 5;
            padding: 0;
            outline: 0;
            appearance: none;
            border: 0;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }
        img {
            max-width: 50px;
            gap: 1rem;
        }
        body {
            width: 100vw;
            height: 100vh;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 0.88rem;
            background: var(--color-background);
            overflow-x: hidden;
            color: var(--color-dark);
        }
        nav {
            background-color: rgba(113, 99, 186, 255);
            width: 100vw;
            height: 5rem;
            position: fixed;
            top: 0;
            z-index: 21;
            color: #fff;
        }
        .nav__container {
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav button {
            display: none;
        }
        .nav__menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .nav__menu a {
            font-size: 1rem;
            transition: var(--transition);
            align-items: center;
            padding-left: 15%;
            color: #fff;
            text-transform: uppercase;
        }
        .nav__menu a:hover {
            color: #ff7782;
        }
        form {
            display: flex;
            flex-direction: row;
            width: 100%;
            margin: 20px auto;
            text-align: center;
            align-items: center;
        }
        /* Style for form labels */
        label {
            margin-bottom: 5px;
            padding-left: 0%;
            width: 103%;
        }
        /* Style for form inputs */
        input, textarea, select {
            padding: 8px;
            margin-bottom: 10px;
            width: 10%;
            box-sizing: border-box;
            background-color: #CBC3E3;
            border-radius: 5px;
        }
        /* Style for submit button */
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
        /* Style for medicine table */
        #medicineTable {
            width: 98%;
            margin-top: 20px;
        }
        /* Style for table headers */
        #medicineTable th {
            background-color: rgba(113, 99, 186, 255);
            color: #fff;
            padding: 10px;
        }
        /* Style for table cells */
        #medicineTable td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        /* Style for new medicine */
        #addMedicine {
            text-align: center;
            margin-top: 5px;
        }
        /* Style for medicine records container */
        #medicineInformation {
            text-align: center;
            margin-top: 30px;
        }
        marquee {
            border-radius: var(--border-radius-1);
            height: 30px;
            text-align: center;
            font-size: x-large;
            margin-top: 0;
            background-color: var(--color-danger);
        }
        .medicine-h1 h1 {
            text-align: center;
            margin-top: 50px;
            margin-right: 10%;
        }
        .danger {
            color: #ff7782;
        }
        .active {
            color: #000;
        }
        h2 {
            align-items: center;
            padding-left: 45%;
        }
        /* Style for hidden class */
    </style>
    <nav>
        <div class="container nav__container">
            <ul class="nav__menu">
                <img src="../Savannah-icon.png">
                <a href="Pharmacist_dashboard.php">
                    <h3>Pharmacist Dashboard</h3>
                </a>
                <a href="Medicine.php">
                    <h3 class="active">Medicine</h3>
                </a>
                <a href="Pharmacist_dashboard.php">
                    <h3>Back</h3>
                </a>
            </ul>
        </div>
    </nav>
    <div class="Medicine-h1">
        <h1>SAVANNAH- <span class="danger">MEDICINE INFORMATION</span></h1>
    </div>
    <br>
    <h2>Medicine Record</h2>
    <table id="medicine_table">
        <div id="medicineInformation">
            <table id="medicineTable">
<!-- Search bar form information -->
                <form method="GET" action="">
                    <input type="text" name="search_query" placeholder="Search by medicine name, Uom, or Manufacturer">
                    <button type="submit" name="search">Search</button>
                    <button type="submit" name="refresh">Refresh</button>
                </form>
                <thead>
                    <tr>
                        <th>Medicine Id</th>
                        <th>Medicine Name</th>
                        <th>Manufacturer</th>
                        <th>Dosage Strength</th>
                        <th>UoM</th>
                        <th>Cost per unit</th>
                        <th>Date added</th>
                        <th>Expiry date</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    // Initialize $result
    $result = null;

    // Check if the search form is submitted
     if (isset($_GET['search'])) {
          // Get the search query from the form
          $search_query = $_GET['search_query'];
  // Fetch and display medicine records from the database based on the search query
         $sql = "SELECT * FROM medicine_table WHERE Med_name LIKE '%$search_query%' OR UoM LIKE '%$search_query%' OR Manufacturer LIKE '%$search_query%'";
         $result = $link->query($sql);

             // Check if there are any results
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["Med_id"] . "</td>";
                                echo "<td>" . $row["Med_name"] . "</td>";
                                echo "<td>" . $row["Manufacturer"] . "</td>";
                                echo "<td>" . $row["Dosage_strength"] . "</td>";
                                echo "<td>" . $row["UoM"] . "</td>";
                                echo "<td>" . $row["Costperunit"] . "</td>";
                                echo "<td>" . $row["Date_added"] . "</td>";
                                echo "<td>" . $row["Exp_date"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // No results found
                            echo "<tr><td colspan='8' style='color: red;'>No results found.</td></tr>";
                        }
                    } else if (isset($_GET['refresh'])) {
                        // Refresh the page to display all records
                        $result = $link->query("SELECT * FROM medicine_table");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Med_id"] . "</td>";
                            echo "<td>" . $row["Med_name"] . "</td>";
                            echo "<td>" . $row["Manufacturer"] . "</td>";
                            echo "<td>" . $row["Dosage_strength"] . "</td>";
                            echo "<td>" . $row["UoM"] . "</td>";
                            echo "<td>" . $row["Costperunit"] . "</td>";
                            echo "<td>" . $row["Date_added"] . "</td>";
                            echo "<td>" . $row["Exp_date"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Fetch and display medicine records from the database
                        $result = $link->query("SELECT * FROM medicine_table");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Med_id"] . "</td>";
                            echo "<td>" . $row["Med_name"] . "</td>";
                            echo "<td>" . $row["Manufacturer"] . "</td>";
                            echo "<td>" . $row["Dosage_strength"] . "</td>";
                            echo "<td>" . $row["UoM"] . "</td>";
                            echo "<td>" . $row["Costperunit"] . "</td>";
                            echo "<td>" . $row["Date_added"] . "</td>";
                            echo "<td>" . $row["Exp_date"] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </table>
</body>
</html>
