<?php
// for fetching the Patients records form the database by using the id
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['updatebtn'])){

    //print_r($_POST); 
    //die();

    $updateQuery = $link->query("UPDATE supplier_table SET Supplier_name =  '".$_POST['Supplier_name']."', Supplier_email =  '".$_POST['Supplier_email']."', Supplier_contact =  '".$_POST['Supplier_contact']."', Date_added = '".$_POST['Date_added']."' WHERE Supplier_id = ".$_POST['Supplier_id']);

    

    header("Location: Supplier.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM supplier_table WHERE Supplier_id = ".$_POST['Supplier_id']);
    
    header("Location: Supplier.php");
}

if (isset($_GET['Supplier_id'])) {
    $Supplier_id = $_GET['Supplier_id'];

    // For getting the Supplier records from the database
    $selectQuery = "SELECT * FROM supplier_table WHERE Supplier_id = $Supplier_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $supplier_table = $result->fetch_assoc();


    } else {
        echo "Supplier not found";
    }
} else {
    echo "Invalid Supplier ID";
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
        <h2>EDIT SUPPLIER</h2>
        <input type="hidden" name="Supplier_id" value="<?php echo $supplier_table['Supplier_id']; ?>">
        <table>
            <tr>
                <td><label for="Supplier_name">Supplier Name:</label></td>
                <td><input type="text" id="Supplier_name" name="Supplier_name" value="<?php echo $supplier_table['Supplier_name']; ?>" required></td>
            </tr>
          
            <tr>
                <td><label for="Supplier_email">Supplier Email:</label></td>
                <td><input type="text" id="Supplier_email" name="Supplier_email" value="<?php echo $supplier_table['Supplier_email']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Supplier_contact">Supplier contact":</label></td>
                <td><input type="text" id="Supplier_contact" name="Supplier_contact" value="<?php echo $supplier_table['Supplier_contact']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Date_added">Date Added:</label></td>
                <td><input type="text" id="Date_added" name="Date_added" value="<?php echo $supplier_table['Date_added']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Supplier</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete Supplier</button>
        <button><a href="Supplier.php">Back</a></button> 
    </form>
</body>