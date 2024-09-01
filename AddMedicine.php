<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Med_name = $_POST['Med_name'];
        $Manufacturer = $_POST['Manufacturer'];
        $Dosage_strength = $_POST['Dosage_strength'];
        $UoM = $_POST['UoM'];
        $Costperunit =$_POST['Costperunit'];
        $Exp_date =$_POST['Exp_date'];

        // Validate the date and time
$date_valid = DateTime::createFromFormat('Y-m-d', $Exp_date) !== false;
        //Insert into database
        $sql ="INSERT INTO medicine_table (Med_name, Manufacturer, Dosage_strength, UoM, Costperunit,  Exp_date)
        VALUES ('$Med_name', '$Manufacturer', '$Dosage_strength', '$UoM', '$Costperunit' ,' $Exp_date')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddMedicine.php");
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
        <title>Add Medicine </title>
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
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="search here" />
            </div>
            <img src="user.jpg" alt="" />
            <?php  echo  $_SESSION['sessionUsername']; ?>

        </div>
         </div>  
         <div class="table--container">
        <h3 class="main--title">Medicine details</h3>
        <form name="medicine_form" method="POST" action="AddMedicine.php">
            <table>
                <tr>
                    <td><label for="Med_name">Medicine Name</label></td>
                    <td><input type="text" id="Med_name" name="Med_name" placeholder="Medicine Name" required></td>
                </tr>
                <tr>
                    <td><label for="Manufacturer">Manufacturer</label></td>
                    <td><input type="text" id="Manufacturer" name="Manufacturer" placeholder="Manufacturer" required></td>
                </tr>
                <tr>
                    <td><label for="Dosage_strength">Dosage strength</label></td>
                    <td><input type="text" id="Dosage_strength" name="Dosage_strength" placeholder="Dosage strength" required></td>
                </tr>
                <tr>
                    <td><label for="UoM">Unit of measure</label></td>
                    <td><input type="text" id="UoM" name="UoM" placeholder="Unit of measure" required></td>
                </tr>
                <tr>
                    <td><label for="Costperunit">Cost per unit</label></td>
                    <td><input type="text" id="Costperunit" name="Costperunit" placeholder="Cost per unit" required></td>
                </tr>
                <tr>
                    <td><label for="Exp_date">Expiry date</label></td>
                    <td><input type="text" id="Exp_date" name="Exp_date" placeholder="Expiry date" required></td>
                </tr>
                
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Medicine.php">Go Back</a></button>
     </form>
        
         
</body>
</html>