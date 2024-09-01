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
        $Quantity_ordered = $_POST['Quantity_ordered'];
        $Supplier_id = $_POST['Supplier_id'];
        $Supplier_email = $_POST['Supplier_email'];
        $Quantity_received = $_POST['Quantity_received'];
        $Unit_price =$_POST['Unit_price'];
        $Total_cost =$_POST['Total_cost'];
        $Order_status =$_POST['Order_status'];


        //Insert into database
        $sql ="INSERT INTO orders_table (Med_id, Quantity_ordered, Supplier_id, Supplier_email, Quantity_received, Unit_price, Total_cost, Order_status)
        VALUES ('$Med_id', '$Quantity_ordered', '$Supplier_id', '$Supplier_email', '$Quantity_received', '$Unit_price', '$Total_cost', '$Order_status')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddOrders.php");
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
        <title>Add Orders </title>
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
        <h3 class="main--title">Order details</h3>
        <form name="order_form" method="POST" action="AddOrders.php">
            <table>
                <tr>
                <td><label for="Med_id">Medicine Id</label></td>
                    <td>
                        <select id="Med_id" name="Med_id"  required>
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
                    <td><label for="Quantity_ordered">Quantity ordered</label></td>
                    <td><input type="text" id="Quantity_ordered" name="Quantity_ordered" placeholder="Quantity ordered" required></td>
                </tr>
                <tr>
                <td><label for="Supplier_id">Supplier Id</label></td>
                    <td>
                        <select id="Supplier_id" name="Supplier_id"  required>
                            <option value="" selected >--Select Supplier</option>
                            <?php

                             // Fetch and display doctors records from the database
                                $result = $link->query("SELECT * FROM supplier_table");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["Supplier_id"] . "'>" . $row["Supplier_name"] . "</option>";                                    
                                }

                            ?>

                        </select>
                    </td>
                            </tr>
                <tr>
                <td><label for="Supplier_email">Supplier email</label></td>
                    <td>
                        <select id="Supplier_email" name="Supplier_email"  required>
                            <option value="" selected >--Select Email</option>
                            <?php

                             // Fetch and display doctors records from the database
                                $result = $link->query("SELECT * FROM supplier_table");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row["Supplier_email"] . "'>" . $row["Supplier_email"] . "</option>";                                    
                                }

                            ?>

                        </select>
                    </td>
                            </tr>
                <tr>
                    <td><label for="Quantity_received">Quantity received</label></td>
                    <td><input type="text" id="Quantity_received" name="Quantity_received" placeholder="Quantity received"></td>
                </tr>
                <tr>
                    <td><label for="Unit_price">Unit price</label></td>
                    <td><input type="text" id="Unit_price" name="Unit_price" placeholder="Unit price" required></td>
                </tr>
                <tr>
                    <td><label for="Total_cost">Total cost</label></td>
                    <td><input type="text" id="Total_cost" name="Total_cost" placeholder="Total cost" ></td>
                </tr>
                <tr>
                    <td><label for="Order_status">Order status</label></td>
                    <td><input type="text" id="Order_status" name="Order_status" placeholder="Order status" required></td>
                </tr>
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Orders.php">Go Back</a></button>
     </form>
        
</body>
</html>