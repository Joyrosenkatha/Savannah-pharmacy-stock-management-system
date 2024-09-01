<?php include('Pharmacist_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Med_id = $_POST['Med_id'];
        $Quantity_dispensed = $_POST['Quantity_dispensed'];
        $Patient_id = $_POST['Patient_id'];
        $Unit_price = $_POST['Unit_price'];
        $Dispensing_cost = $_POST['Dispensing_cost'];
    
        
        //Insert into database
        $sql ="INSERT INTO dispensations_table (Med_id, Quantity_dispensed, Patient_id, Unit_price, Dispensing_cost)
        VALUES ('$Med_id', '$Quantity_dispensed', '$Patient_id', '$Unit_price', '$dispensing_cost')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddNewDispensation.php");
            exit();
        } else {
            echo "Error: " .$sql . "<br>" . $link->error;
        }
    }
    
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Add Dispensation </title>
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
            
            <h2>Pharmacist Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="search here" />
            </div>
            <img src="user.jpg" alt="" />
            <?php  echo  $_SESSION['sessionUsername']; ?>
        </div>
         </div>  
         <div class="table--container">
        <h3 class="main--title">Dispensation details</h3>
        <form name="dispensation_form" method="POST" action="AddDispensation.php">
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
                    <td><label for="Quantity_dispensed">Quantity dispensed</label></td>
                    <td><input type="text" id="Quantity_dispensed" name="Quantity_dispensed" placeholder="Quantity dispensed" required></td>
                </tr>
                <tr>
                <td><label for="Patient_id">Patient Id</label></td>
                    <td>
                        <select id="Patient_id" name="Patient_id" required>
                            <option value="" selected >--Select Patient</option>
                            <?php

                             // Fetch and display doctors records from the database
                                $result = $link->query("SELECT * FROM patients_table");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["Patient_id"] . "'>" . $row["Patient_name"] . "</option>";                                    
                                }

                            ?>

                        </select>
                    </td>
                            </tr>
    
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Pharmacist_dashboard.php">Go Back</a></button>
                    </form>
        
</body>
</html>