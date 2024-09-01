<?php
// for fetching the order records form the database by using the id
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['updatebtn'])){

    //print_r($_POST); 
    //die();

    $updateQuery = $link->query("UPDATE orders_table SET Med_id =  '".$_POST['Med_id']."', Quantity_ordered =  '".$_POST['Quantity_ordered']."', Supplier_id =  '".$_POST['Supplier_id']."', Supplier_email =  '".$_POST['Supplier_email']."', Date_ordered =  '".$_POST['Date_ordered']."', Quantity_received =  '".$_POST['Quantity_received']."', Unit_price =  '".$_POST['Unit_price']."', Total_cost =  '".$_POST['Total_cost']."', Order_status =  '".$_POST['Order_status']."' WHERE Order_id = ".$_POST['Order_id']);
    

    header("Location: Orders.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM orders_table WHERE Order_id = ".$_POST['Order_id']);
    
    header("Location: Orders.php");
}

if (isset($_GET['Order_id'])) {
    $Order_id = $_GET['Order_id'];

    // For getting the Order records from the database
    $selectQuery = "SELECT * FROM orders_table WHERE Order_id = $Order_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $orders_table = $result->fetch_assoc();


    } else {
        echo "Order not found";
    }
} else {
    echo "Invalid Order ID";
}
?>
<!DOCTYPE html>
        <html lang="en">
        <head>
        
        </head>

        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100%;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 30px;
            margin-top: 70px;
        }
        h2{
            color: rgba(113, 99, 186, 255);
            padding-left: 30%;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: rgba(113, 99, 186, 255);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: purple;
        }
    </style>
<body>
<form action="#" method="post">
        <h2>EDIT ORDER</h2>
        <input type="hidden" name="Order_id" value="<?php echo $orders_table['Order_id']; ?>">
        <table>
            <tr>
                <td><label for="Med_id">Medicine Id:</label></td>
                <td><input type="text" id="Med_id" name="Med_id" value="<?php echo $orders_table['Med_id']; ?>" required></td>
            </tr>
          
            <tr>
                <td><label for="Quantity_ordered">Quantity Ordered:</label></td>
                <td><input type="text" id="Quantity_ordered" name="Quantity_ordered" value="<?php echo $orders_table['Quantity_ordered']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Supplier_id">Supplier Id:</label></td>
                <td><input type="text" id="Supplier_id" name="Supplier_id" value="<?php echo $orders_table['Supplier_id']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Supplier_email">Supplier Email:</label></td>
                <td><input type="text" id="Supplier_email" name="Supplier_email" value="<?php echo $orders_table['Supplier_email']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Date_ordered">Date Ordered:</label></td>
                <td><input type="datetime-local" id="Date_ordered" name="Date_ordered" value="<?php echo $orders_table['Date_ordered']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Quantity_received">Quantity received:</label></td>
                <td><input type="text" id="Quantity_received" name="Quantity_received" value="<?php echo $orders_table['Quantity_received']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Unit_price">Unit price:</label></td>
                <td><input type="text" id="Unit_price" name="Unit_price" value="<?php echo $orders_table['Unit_price']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Total_cost">Total cost:</label></td>
                <td><input type="text" id="Total_cost" name="Total_cost" value="<?php echo $orders_table['Total_cost']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Order_status">Order status:</label></td>
                <td><input type="text" id="Order_status" name="Order_status" value="<?php echo $orders_table['Order_status']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Order</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete Order</button>
        <button><a href="Orders.php">Back</a></button> </h2>
    </form>
</body>