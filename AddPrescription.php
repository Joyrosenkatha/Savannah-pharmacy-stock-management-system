<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Patient_id = $_POST['Patient_id'];
        $Med_id = $_POST['Med_id'];
        $Dosage = $_POST['Dosage'];
        $Doc_name =$_POST['Doc_name'];

        
        //Insert into database
        $sql ="INSERT INTO prescriptions_table (Patient_id, Med_id, Dosage, Doc_name)
        VALUES ('$Patient_id', '$Med_id', '$Dosage', '$Doc_name')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddPrescription.php");
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
        <title>Add Prescription </title>
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
    <h3 class="main--title">Prescription details</h3>
    <form name="prescription_form" method="POST" action="AddPrescription.php">
        <table>
            <tr>
            <td><label for="Patient_id">Patient</label></td>
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
            <tr>
            <td><label for="Med_id">Medicine</label></td>
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
                <td><label for="Dosage">Dosage</label></td>
                <td><input type="text" id="Dosage" name="Dosage" placeholder="Dosage" required></td>
            </tr>
            <tr>
                <td><label for="Doc_name">Doctor's Name</label></td>
                <td><input type="text" id="Doc_name" name="Doc_name" placeholder="Doctor's Name" required></td>
            </tr>
            <tr>
                <td><label for="Status">Status</label></td>
                <td><input type="text" id="Status" name="Status" placeholder="Status" required></td>
            </tr>
            
        </table>
        <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Prescriptions.php">Go Back</a></button>
     </form>
    
</body>
</html>