<?php


// Include database connection and authentication files
include('conn.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <title>Savanna | Medicine </title>

    
</head>
<script>
    
    function editSupplier(SupplierId) {
        // Redirect to a PHP script that handles the edit operation
        window.location.href = 'Edit_supplier.php?Supplier_id=' + SupplierId;
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
    gap: 1.5rem;
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

/* Style for the supplier table */
#supplierTable {
    width: 98%;
    
    margin-top: 20px;
}

/* Style for table headers */
#supplierTable th {
    background-color: rgba(113, 99, 186, 255);
    color: #fff;
    padding: 10px;
}

/* Style for table cells */
#supplierTable td {
    border: 1px solid #ddd;
    padding: 8px;
}

/* Style for new supplier container */
#addSupplier {
    text-align: center;
    margin-top: 5px;
}

/* Style for supplier information container */
#supplierInformation {
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
.medicine-h1 h1{
    
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
                                <a href="Admin_dashboard.php" >
                                    <h3>Dashboard</h3>
                                </a>
                              
            
                                <a href="Supplier.php">
                                    <h3 class="active">Supplier</h3>
                                </a>
            
                             
                                <a href="AddSupplier.php" >
                                    <h3>Add New Supplier</h3>
                                </a>
                               
                                <a href="Admin_dashboard.php">
                                    <h3>Logout</h3>
                                </a>  
            </ul>    
                        </div>
                
                    </nav>


</head>
                <body>      
            <div class="Supplier-h1">
                       <h1>SAVANNAH- <span class="danger">SUPPLIER INFORMATION</span></h1>
                    </div>
                    <br>

            <h2>Supplier Record</h2>
            
            <table id="supplier_table">
                
                <div id="supplierInformation">
                <table id="supplierTable">
                    <!-- Search bar form -->
<form method="GET" action="">
    <input type="text" name="search_query" placeholder="Search by supplier name, or supplier email">
    <button type="submit" name="search">Search</button>
    <button type="submit" name="search">Refresh</button>
</form>
<thead>
                    <tr>
                        <th>Supplier Id</th>
                        <th>Supplier Name</th>
                        <th>Supplier Email</th>
                        <th>Supplier Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

// Initialize $result
$result = null;

// Check if the search form is submitted
if(isset($_GET['search'])) {
    // Get the search query from the form
    $search_query = $_GET['search_query'];
    
  // Fetch and display supplier records from the database based on the search query
  $sql = "SELECT * FROM supplier_table WHERE Supplier_name LIKE '%$search_query%' OR Supplier_email LIKE '%$search_query%'";
 
  // Get result
  $result = $link->query($sql);
  
  // Check if there are any results
  if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["Supplier_id"] . "</td>";
          echo "<td>" . $row["Supplier_name"] . "</td>";
          echo "<td>" . $row["Supplier_email"] . "</td>";
          echo "<td>" . $row["Supplier_contact"] . "</td>";
          echo "<td><button onclick=\"editSupplier('{$row['Supplier_id']}')\">Update</button>";
          echo "</tr>";
        }
       
        exit();
    } else {
        // No results found
        echo "<tr><td colspan='14' style='color: red;'>No results found.</td></tr>";

    }

} 



                // Fetch and display supplier records from the database
        $result = $link->query("SELECT * FROM supplier_table");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Supplier_id"] . "</td>";
          echo "<td>" . $row["Supplier_name"] . "</td>";
          echo "<td>" . $row["Supplier_email"] . "</td>";
          echo "<td>" . $row["Supplier_contact"] . "</td>";
            echo "<td><button onclick=\"editSupplier('{$row['Supplier_id']}')\">Update</button>";
            echo "</tr>";
        }
        ?>

                </tbody>
            </table>
        
           
            </div>
    </div>
         
        </body>
        </html>
