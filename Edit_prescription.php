<?php 
// Fetch the order details based on the prescription ID from the database and pre-fill the form for editing
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

//To check for error
if (!$link) {
    //die stops the script from being executed
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['updatebtn'])){

    //print_r($_POST); 
    //die();

    $updateQuery = $link->query("UPDATE prescriptions_table SET  `Status` =  '".$_POST['Status']."' WHERE Prescription_id = ".$_POST['Prescription_id']);
    

    header("Location: PrescriptionList.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM prescriptions_table WHERE Prescription_id = ".$_POST['Prescription_id']);
    
    header("Location: PrescriptionList.php");
}


if (isset($_GET['Prescription_id'])) {
    $Prescription_id = $_GET['Prescription_id'];

    // Fetch the prescription details from the database
    $selectQuery = "SELECT * FROM prescriptions_table WHERE Prescription_id = $Prescription_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $prescriptions_table = $result->fetch_assoc();


        // Note: Display the form for editing based on the fetched details
        // You may use JavaScript to show/hide the form or redirect to an edit page
    } else {
        echo "Prescription not found";
    }
} else {
    echo "Invalid Prescription ID";
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
    <form action="#" method="POST" >
        <h2>EDIT Prescription</h2>
        <input type="hidden" name="Prescription_id" value="<?php echo $prescriptions_table['Prescription_id']; ?>">
        <table>
            <tr>
                <td><label for="Patient_id">Patient id</label></td>
                <td><input type="text" id="Patient_id" name="Patient_id" disabled value="<?php echo $prescriptions_table['Patient_id']; ?>" ></td>
            </tr>
          
            <tr>
                <td><label for="Med_id">Med_id:</label></td>
                <td><input type="text" id="Med_id" name="Med_id" disabled value="<?php echo $prescriptions_table['Med_id']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Prescription_date">Prescription_date:</label></td>
                <td><input type="text" id="Prescription_date" name="Prescription_date" disabled value="<?php echo $prescriptions_table['Prescription_date']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Dosage">Dosage:</label></td>
                <td><input type="text" id="email" name="email" disabled value="<?php echo $prescriptions_table['Dosage']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Doc_name">Doc_name:</label></td>
                <td><input type="text" id="Doc_name" name="Doc_name" disabled value="<?php echo $prescriptions_table['Doc_name']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Status">Status:</label></td>
                <td><input type="text" id="Status" name="Status" value="<?php echo $prescriptions_table['Status']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Prescription</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete Prescription</button>
        <button><a href="PrescriptionList.php">Back</a></button> 
    </form>
</body>
