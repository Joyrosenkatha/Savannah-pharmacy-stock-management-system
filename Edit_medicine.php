<?php
// for fetching the medicine records form the database by using the id
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['updatebtn'])){

    //print_r($_POST); 
    //die();

    $updateQuery = $link->query("UPDATE medicine_table SET Manufacturer =  '".$_POST['Manufacturer']."', Med_name =  '".$_POST['Med_name']."',Costperunit =  '".$_POST['Costperunit']."', UoM =  '".$_POST['UoM']."' WHERE Med_id = ".$_POST['Med_id']);
    

    header("Location: Medicine.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM medicine_table WHERE Med_id = ".$_POST['Med_id']);
    
    header("Location: Medicine.php");
}

if (isset($_GET['Med_id'])) {
    $Med_id = $_GET['Med_id'];

    // For getting the Medicine records from the database
    $selectQuery = "SELECT * FROM medicine_table WHERE Med_id = $Med_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $medicine_table = $result->fetch_assoc();


    } else {
        echo "Medicine not found";
    }
} else {
    echo "Invalid Medicine ID";
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
        <input type="hidden" name="Med_id" value="<?php echo $medicine_table['Med_id']; ?>">
        <table>
            <tr>
                <td><label for="Med_name">Medicine Name:</label></td>
                <td><input type="text" id="Med_name" name="Med_name" value="<?php echo $medicine_table['Med_name']; ?>" required></td>
            </tr>
          
            <tr>
                <td><label for="Manufacturer">Manufacturer:</label></td>
                <td><input type="text" id="Manufacturer" name="Manufacturer" value="<?php echo $medicine_table['Manufacturer']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Dosage_strength">Dosage Strength:</label></td>
                <td><input type="text" id="Dosage_strength" name="Dosage_strength" value="<?php echo $medicine_table['Dosage_strength']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="UoM">UoM:</label></td>
                <td><input type="text" id="UoM" name="UoM" value="<?php echo $medicine_table['UoM']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Costperunit">CostperUnit:</label></td>
                <td><input type="text" id="Costperunit" name="Costperunit" value="<?php echo $medicine_table['Costperunit']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Date_added">Date Added:</label></td>
                <td><input type="text" id="Date_added" name="Date_added" value="<?php echo $medicine_table['Date_added']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Exp_date">Expiry Date:</label></td>
                <td><input type="text" id="Exp_date" name="Exp_date" value="<?php echo $medicine_table['Exp_date']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Medicine</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete Medicine</button>
        <button><a href="Medicine.php">Back</a></button> </h2>
    </form>
</body>