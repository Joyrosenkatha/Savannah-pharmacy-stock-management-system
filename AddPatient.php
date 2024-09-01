<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Patient_name = $_POST['Patient_name'];
        $Gender = $_POST['Gender'];
        $DateOfBirth = $_POST['DateOfBirth'];
        $Phone_Number =$_POST['Phone_Number'];
        $Email =$_POST['Email'];
        $Address =$_POST['Address'];
        $City =$_POST['City'];

        //validate DOB
        $date = new DateTime($DateOfBirth); 
        $now = new DateTime();        
        if($date < $now) {
            //proceed            
        }else{
            header("Location: AddPatient.php?error=Invalid Date of birth");           
            die();
        }
        //Insert into database
        $sql ="INSERT INTO patients_table (Patient_name, Gender, DateOfBirth, Phone_Number, Email, Address, City)
        VALUES ('$Patient_name', '$Gender', '$DateOfBirth', '$Phone_Number', '$Email' ,' $Address' , '$City')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddPatient.php");
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
        <title>Add Patient </title>
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
    <h3 class="main--title">Patient's records</h3>
    <form name="patients_form" method="POST" action="AddPatient.php">
        <table>
            <tr>
                <td><label for="Patient_name">Patient Name</label></td>
                <td><input type="text" id="Patient_name" name="Patient_name" placeholder="Patient Name" required></td>
            </tr>
            <tr>
                <td><label for="Gender">Gender</label></td>
                <td><input type="text" id="Gender" name="Gender" placeholder="Gender" required></td>
            </tr>
            <tr>
                <td><label for="DateOfBirth">Date of Birth</label></td>
                <td><input type="text" id="DateOfBirth" name="DateOfBirth" placeholder="Date of Birth" required></td>
            </tr>
            <tr>
                <td><label for="Phone_Number">Phone Number</label></td>
                <td><input type="text" id="Phone_Number" name="Phone_Number" placeholder="Phone Number" required></td>
            </tr>
            <tr>
                <td><label for="Email">Email</label></td>
                <td><input type="text" id="Email" name="Email" placeholder="Email" required></td>
            </tr>
            <tr>
                <td><label for="Address">Address</label></td>
                <td><input type="text" id="Address" name="Address" placeholder="Address" required></td>
            </tr>
            <tr>
                <td><label for="City">City</label></td>
                <td><input type="text" id="City" name="City" placeholder="City" required></td>
            </tr>
            
        </table>
        <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Patient.php">Go Back</a></button>
        </form>
    
    </body>
</html>