<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Supplier_name = $_POST['Supplier_name'];
        $Supplier_email = $_POST['Supplier_email'];
        $Supplier_contact = $_POST['Supplier_contact'];

        //Insert into database
        $sql ="INSERT INTO supplier_table (Supplier_name, Supplier_email, Supplier_contact)
        VALUES ('$Supplier_name', '$Supplier_email', '$Supplier_contact')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddSupplier.php");
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
        <title>Add Supplier </title>
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
    <h3 class="main--title">Supplier details</h3>
    <form name="supplier_form" method="POST" action="AddSupplier.php">
        <table>
            <tr>
                <td><label for="Supplier_name">Supplier Name</label></td>
                <td><input type="text" id="Supplier_name" name="Supplier_name" placeholder="Supplier Name" required></td>
            </tr>
            <tr>
                <td><label for="Supplier_email">Supplier Email</label></td>
                <td><input type="text" id="Supplier_email" name="Supplier_email" placeholder="Supplier Email" required></td>
            </tr>
            <tr>
                <td><label for="Supplier_contact">Supplier Contact</label></td>
                <td><input type="text" id="Supplier_contact" name="Supplier_contact" placeholder="Supplier Contact" required></td>
            </tr>
            
        </table>
        <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Supplier.php">Go Back</a></button>
     </form>
</body>
</html>