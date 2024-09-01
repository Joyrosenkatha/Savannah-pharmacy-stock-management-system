<?php
// Establishes a connection to a MySQL database using the mysqli_connect function. 
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

//Checks for error if the connection fails
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <title>Savanna | Dispensations </title>

    
</head>
<script>

    function editDispensation(DispensationId) {
        //It redirects to a PHP script where the edit operation is done
        window.location.href = 'Edit_dispensationRecords.php?Dis_id=' + DispensationId;
    }
</script>

<body>
    
<style>
/* Style for form container */
*{
    margin:5;
    padding: 0;
    outline: 0;
    appearance: none;
    border: 0;
    text-decoration: none;
    list-style: none;
    box-sizing: border-box;
}
img{ 
    max-width: 50px;
    gap: 1rem;
}
body{
    width: 100vw;
    height: 100vh;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 0.88rem;
    background: var(--color-background);
    
    overflow-x: hidden ;
    color: var(--color-dark);

}
nav{
    background-color: rgba(113, 99, 186, 255);
    width: 100vw;
    height:5rem ;
    position: fixed;
    top: 0;
    z-index: 21;
    color:#fff;
    
}

.nav__container{
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
nav button{
    display: none;
}
.nav__menu{
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.nav__menu a{
    font-size: 1rem;
    transition: var(--transition);
    align-items: center;
    padding-left: 15%;
    color: #fff;
    text-transform: uppercase;
}
.nav__menu a:hover{
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
input ,
textarea,
select{
    padding: 8px;
    margin-bottom: 10px;
    width: 10%;
    box-sizing: border-box;
    background-color:  #CBC3E3;
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

/* Style for order table */
#dispensationTable {
    width: 98%;
    
    margin-top: 20px;
}

/* Style for table headers */
#dispensationTable th {
    background-color: rgba(113, 99, 186, 255);
    color: #fff;
    padding: 10px;
}

/* Style for table cells */
#dispensationTable td {
    border: 1px solid #ddd;
    padding: 8px;
}

/* Style for new orders container */
#addDispensation {
    text-align: center;
    margin-top: 5px;
}

/* Style for online orders information container */
#dispensationInformation {
    text-align: center;
    margin-top: 30px;
}
marquee{
    border-radius: var(--border-radius-1);
    height: 30px;
    text-align: center;
    font-size:x-large;
    margin-top: 0;
    background-color: var(--color-danger);
}
.dispensation-h1 h1{
    
    text-align: center;
    margin-top: 50px;
    margin-right: 10%;
}
.danger{
    color: #ff7782;
}
.active{
    color: #000;
}
h2{
    align-items: center;
    padding-left: 45%;

}


/* Style for hidden class */

</style>  
<nav>
            
<div class="container nav__container">
 <ul class="nav__menu">
 <img src="../Savannah-icon.png">
            <a href="Pharmacist_dashboard.php" >
                     <h3>Dashboard</h3>
                        </a>
       
                        <a href="DispensationRecords.php">
                          <h3 class="active">Dispensation</h3>
                            </a>
        
                            <a href="Pharmacist_dashboard.php">
                             <h3>Back</h3>
                                </a>  
            </ul>    
                        </div>
                
                    </nav>


</head>
                <body>      
            <div class="dispensation-h1">
                       <h1>SAVANNAH- <span class="danger">DISPENSATION INFORMATION</span></h1>
                    </div>

            <h2>Dispensation Record</h2>
            <table id="dispensation_table">
                
                <div id="dispensationInformation">
                <table id="dispensationTable">
                    <!-- Search bar form -->
<form method="GET" action="">
    <input type="text" name="search_query" placeholder="Search by medicine id, patient id">
    <button type="submit" name="search">Search</button>
    <button type="submit" name="search">Refresh</button>
</form>
<thead>
                    <tr>
                        <th>Dispensation Id</th>
                        <th>Medicine Id</th>
                        <th>Quantity Dispensed</th>
                        <th>Patient Id</th></th>
                        <th>Unit price</th>
                        <th>Dispensing Date</th>
                        <th>Dispensing Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

// Initialize $result
$result = null;

// Check if the search form is submitted
if(isset($_GET['search'])) {
    // retrieves the value of the search query parameter 
    $search_query = $_GET['search_query'];
    
  // Fetch and display Dispensation records from the database based on the search query
  $sql = "SELECT * FROM dispensations_table WHERE Med_id LIKE '%$search_query%' OR Patient_id LIKE  '%$search_query%'";

  // Get result
  $result = $link->query($sql);
  
  // Check if there are any results
  if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
            //the code used to calculate the dispensing cost

        $Dispensing_cost = $row["Quantity_dispensed"] * $row["Unit_price"];

          echo "<tr>";
          echo "<td>" . $row["Dis_id"] . "</td>";
          echo "<td>" . $row["Med_id"] . "</td>";
          echo "<td>" . $row["Quantity_dispensed"] . "</td>";
          echo "<td>" . $row["Patient_id"] . "</td>";
          echo "<td>" . $row["Unit_price"] . "</td>";
          echo "<td>" . $row["Dispensing_date"] . "</td>";
          echo "<td>" . $Dispensing_cost . "</td>";
          echo "<td><button onclick=\"editDispensation('{$row['Dis_id']}')\">Update</button>";
          echo "</tr>";
        }
       
        exit();
    } else {
        // No results found
        echo "<tr><td colspan='14' style='color: red;'>No results found.</td></tr>";

    }

} 



                // Fetch and display Dispensation records from the database
        $result = $link->query("SELECT * FROM dispensations_table");
        while ($row = $result->fetch_assoc()) {
            $Dispensing_cost = $row["Quantity_dispensed"] * $row["Unit_price"];
            echo "<tr>";
            echo "<td>" . $row["Dis_id"] . "</td>";
          echo "<td>" . $row["Med_id"] . "</td>";
          echo "<td>" . $row["Quantity_dispensed"] . "</td>";
          echo "<td>" . $row["Patient_id"] . "</td>";
          echo "<td>" . $row["Unit_price"] . "</td>";
          echo "<td>" . $row["Dispensing_date"] . "</td>";
          echo "<td>" . $Dispensing_cost . "</td>";
            echo "<td><button onclick=\"editDispensation('{$row['Dis_id']}')\">Update</button>";
            echo "</tr>";
        }
        ?>

                </tbody>
         
            </table>
        
           
            </div>
    </div>
         
        </body>
        </html>
