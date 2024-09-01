<?php
// for fetching the Stock records form the database by using the id
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['updatebtn'])){

    //print_r($_POST); 
    //die();

    $updateQuery = $link->query("UPDATE stocks_table SET Med_id =  '".$_POST['Med_id']."', Quantity_in_Stock =  '".$_POST['Quantity_in_Stock']."', Expiry_date =  '".$_POST['Expiry_date']."', Supplier_name = '".$_POST['Supplier_name']."', Date_acquired ='".$_POST['Date_acquired']."', Status = '".$_POST['Status']."' WHERE Stock_id = ".$_POST['Stock_id']);
    

    header("Location: StockList.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM stocks_table WHERE Stock_id = ".$_POST['Stock_id']);
    
    header("Location: StockList.php");
}

if (isset($_GET['Stock_id'])) {
    $Stock_id = $_GET['Stock_id'];

    // For getting the Stock records from the database
    $selectQuery = "SELECT * FROM stocks_table WHERE Stock_id = $Stock_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $stocks_table = $result->fetch_assoc();


    } else {
        echo "Stock not found";
    }
} else {
    echo "Invalid Stock ID";
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
        <h2>EDIT STOCK</h2>
        <input type="hidden" name="Stock_id" value="<?php echo $stocks_table['Stock_id']; ?>">
        <table>
            <tr>
                <td><label for="Med_id">Med Id:</label></td>
                <td><input type="text" id="Med_id" name="Med_id" value="<?php echo $stocks_table['Med_id']; ?>" required></td>
            </tr>
          
            <tr>
                <td><label for="Quantity_in_Stock">Quantity in Stock:</label></td>
                <td><input type="text" id="Quantity_in_Stock" name="Quantity_in_Stock" value="<?php echo $stocks_table['Quantity_in_Stock']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Expiry_date">Expiry date:</label></td>
                <td><input type="date" id="Expiry_date" name="Expiry_date" value="<?php echo $stocks_table['Expiry_date']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Supplier_name">Supplier Name:</label></td>
                <td><input type="text" id="Supplier_name" name="Supplier_name" value="<?php echo $stocks_table['Supplier_name']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Date_acquired">Date acquired:</label></td>
                <td><input type="datetime-local" id="Date_acquired" name="Date_acquired" value="<?php echo $stocks_table['Date_acquired']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Status">Status:</label></td>
                <td><input type="text" id="Status" name="Status" value="<?php echo $stocks_table['Status']; ?>" required></td>
            </tr>
            
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Stock</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete Stock</button>
        <button><a href="StockList.php">Back</a></button> </h2>
    </form>
</body>