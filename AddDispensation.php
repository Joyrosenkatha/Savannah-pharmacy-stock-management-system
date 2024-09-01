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
        $Quantity_dispensed = $_POST['Quantity_dispensed'];
        $Patient_id = $_POST['Patient_id'];
        $Dispensing_cost = $_POST['Dispensing_cost'];
    
        //Insert into database
        $sql ="INSERT INTO dispensations_table (Med_id, Quantity_dispensed, Patient_id, Dispensing_cost)
        VALUES ('$Med_id', '$Quantity_dispensed', '$Patient_id', '$dispensing_cost')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddDispensation.php");
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
         <!-- acts as container for the table that will display the dispensation details-->
         <div class="table--container">
            <!--indicates the section of dispensation details-->
        <h3 class="main--title">Dispensation details</h3>
        <form name="dispensation_form" method="POST" action="AddDispensation.php">
            <!--table element is used to organize the form inputs in a tabular format-->
            <table>
                <tr>
                    <td><label for="Med_id">Med Id</label></td>
                    <td><input type="text" id="Med_id" name="Med_id" placeholder="Med Id" required></td>
                </tr>
                <tr>
                    <td><label for="Quantity_dispensed">Quantity Dispensed</label></td>
                    <td><input type="text" id="Quantity_dispensed" name="Quantity_dispensed" placeholder="Quantity Dispensed" required></td>
                </tr>
                <tr>
                    <td><label for="Patient_id">Patient Id</label></td>
                    <td><input type="text" id="Patient_id" name="Patient_id" placeholder="Patient Id" required></td>
                </tr>
                <tr>
                    <td><label for="Unit_price">Unit Price</label></td>
                    <td><input type="text" id="Unit_price" name="Unit_price" placeholder="Unit Price" required></td>
                </tr>
                <tr>
                    <td><label for="Dispensing_cost">Dispensing Cost</label></td>
                    <td><input type="text" id="Dispensing_cost" name="Dispensing_cost" placeholder="Dispensing Cost"></td>
                </tr>
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Dispensations.php">Go Back</a></button>
                    
                    </form>
    
</body>
</html>