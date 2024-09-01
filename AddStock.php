<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Med_id = $_POST['Med_id'];
        $Quantity_in_Stock = $_POST['Quantity_in_Stock'];
        $Expiry_date = $_POST['Expiry_date'];
        $Supplier_id = $_POST['Supplier_id'];
        $Status =$_POST['Status'];
       
// Validate the date and time
$date_valid = DateTime::createFromFormat('Y-m-d', $Expiry_date) !== false;
        
        //Insert into database
        $sql ="INSERT INTO stocks_table (Med_id, Quantity_in_Stock, Expiry_date, Supplier_id, Status)
        VALUES ('$Med_id', '$Quantity_in_Stock', '$Expiry_date', '$Supplier_id', '$Status')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddStock.php");
            exit();
        } else {
            echo "Error: " .$sql . "<br>" . $link->error;
        }
    }else {
        echo "<script>alert('Invalid date format. Please use YYYY-MM-DD.');</script>";
    }
    
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Add Stock</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
        

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
            
            <h2>Admin Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                <input type="text" placeholder="search here" />
            </div>
            <img src="user.jpg" alt="" />
            <?php  echo  $_SESSION['sessionUsername']; ?>

        </div>
         </div>  
         <div class="table--container">
    <h3 class="main--title">Stock details</h3>
    <form name="stock_form" method="POST" action="AddStock.php">
        <table>
            <tr>
            <td><label for="Med_id">Medicine Id</label></td>
                    <td>
                        <select id="Med_id" name="Med_id" required>
                            <option value="" selected >--Select Medicine</option>
                            <?php

                             // Fetch and display doctors records from the database
                                $result = $link->query("SELECT * FROM medicine_table");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["Med_id"] . "'>" . $row["Med_name"] . "</option>";                                    
                                }

                            ?>

                        </select>
                    </td>
                </tr>                
            <tr>
                <td><label for="Quantity_in_Stock">Quantity in Stock</label></td>
                <td><input type="text" id="Quantity_in_Stock" name="Quantity_in_Stock" placeholder="Quantity in Stock" required></td>
            </tr>
            <tr>
                <td><label for="Expiry_date">Expiry Date</label></td>
                <td><input type="text" id="Expiry_date" name="Expiry_date" placeholder="Expiry Date" required></td>
            </tr>
            <tr>
            <td><label for="Supplier_id">Supplier Id</label></td>
                    <td>
                        <select id="Supplier_id" name="Supplier_id" required>
                            <option value="" selected >--Select Supplier</option>
                            <?php

                             // Fetch and display Supplier records from the database
                                $result = $link->query("SELECT * FROM supplier_table");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["Supplier_id"] . "'>" . $row["Supplier_name"] . "</option>";                                    
                                }

                            ?>

                        </select>
                    </td>
                </tr>                
            <tr>
                <td><label for="Status">Status</label></td>
                <td><input type="text" id="Status" name="Status" placeholder="Status" required></td>
            </tr>
            
        </table>
        <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Stock.php">Go Back</a></button>
     </form>
</body>
</html>