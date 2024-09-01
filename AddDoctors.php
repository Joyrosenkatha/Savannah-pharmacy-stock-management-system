<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Doc_name = $_POST['Doc_name'];
        $Specialization = $_POST['Specialization'];
        $Doc_contact = $_POST['Doc_contact'];
        

      
        //Insert into database
        $sql ="INSERT INTO doctors_table (Doc_name, Specialization, Doc_contact)
        VALUES ('$Doc_name', '$Specialization', '$Doc_contact')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddDoctors.php");
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
        <title>Add Doctor </title>
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
        <h3 class="main--title">Doctors details</h3>
        <form name="Doctors_form" method="POST" action="AddDoctors.php">
            <table>
                <tr>
                    <td><label for="Doc_name">Doctor Name</label></td>
                    <td><input type="text" id="Doc_name" name="Doc_name" placeholder="Doctor Name" required></td>
                </tr>
                <tr>
                    <td><label for="Specialization">Specialization</label></td>
                    <td><input type="text" id="Specialization" name="Specialization" placeholder="Specialization" required></td>
                </tr>
                <tr>
                    <td><label for="Doc_contact">Doctor's Contact</label></td>
                    <td><input type="text" id="Doc_contact" name="Doc_contact" placeholder="Doctor Contact" required></td>
                </tr>
               
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Doctors.php">Go Back</a></button>
                    
                    </form>
</body>
</html>