<?php
// fetching records from the database by using the id
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

// To check for error
if (!$link) {
    // die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['updatebtn'])) {
    // Update query
    $updateQuery = $link->query(
        "UPDATE dispensations_table 
        SET Med_id = '" . $_POST['Med_id'] . "', 
            Quantity_dispensed = '" . $_POST['Quantity_dispensed'] . "', 
            Patient_id = '" . $_POST['Patient_id'] . "', 
            Dispensing_date = '" . $_POST['Dispensing_date'] . "',  
            Unit_price = '" . $_POST['Unit_price'] . "', 
            Dispensing_cost = '" . $_POST['Dispensing_cost'] . "' 
        WHERE Dis_id = " . $_POST['Dis_id']
    );

    header("Location: DispensationRecords.php");
}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM dispensations_table WHERE Dis_id = ".$_POST['Dis_id']);
    
    header("Location: DispensationRecords.php");
}
if (isset($_GET['Dis_id'])) {
    $Dis_id = $_GET['Dis_id'];

    // For fetching the dispensation records from the database with join
    $selectQuery = "
        SELECT d.*, m.costperunit AS Unit_price 
        FROM dispensations_table d
        JOIN medicine_table m ON d.Med_id = m.Med_id
        WHERE d.Dis_id = $Dis_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $dispensations_table = $result->fetch_assoc();
    } else {
        echo "Dispensation not found";
    }
} else {
    echo "Invalid Dispensation ID";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dispensation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
        h2 {
            color: rgba(113, 99, 186, 255);
            text-align: center;
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

        .back-button {
            background-color: #ccc;
            color: #000;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="#" method="post">
        <h2>EDIT DISPENSATION</h2>
        <input type="hidden" name="Dis_id" value="<?php echo $dispensations_table['Dis_id']; ?>">
        <label for="Med_id">Medicine Id:</label>
        <input type="text" id="Med_id" name="Med_id" value="<?php echo $dispensations_table['Med_id']; ?>" required>

        <label for="Quantity_dispensed">Quantity dispensed:</label>
        <input type="text" id="Quantity_dispensed" name="Quantity_dispensed" value="<?php echo $dispensations_table['Quantity_dispensed']; ?>" required>

        <label for="Patient_id">Patient Id:</label>
        <input type="text" id="Patient_id" name="Patient_id" value="<?php echo $dispensations_table['Patient_id']; ?>" required>

        <label for="Dispensing_date">Dispensing Date:</label>
        <input type="text" id="Dispensing_date" name="Dispensing_date" value="<?php echo $dispensations_table['Dispensing_date']; ?>" required>

        <label for="Unit_price">Unit Price:</label>
        <input type="text" id="Unit_price" name="Unit_price" value="<?php echo $dispensations_table['Unit_price']; ?>" readonly>

        <label for="Dispensing_cost">Dispensing Cost:</label>
        <input type="text" id="Dispensing_cost" name="Dispensing_cost" value="<?php echo $dispensations_table['Dispensing_cost']; ?>">

        <button type="submit" id="updatebtn" name="updatebtn">Update Record</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this record?');">Delete Record</button>
        
        <button><a href="DispensationRecords.php" class="back-button">Back</a></button>
    </form>
</body>
</html>
