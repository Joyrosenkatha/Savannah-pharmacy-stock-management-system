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

    $updateQuery = $link->query("UPDATE patient_booking SET  `Booking_status` =  '".$_POST['Booking_status']."' WHERE Booking_id = ".$_POST['Booking_id']);
    

    header("Location: Doctor_dashboard.php");

}

if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM patient_booking WHERE Booking_id = ".$_POST['Booking_id']);
    
    header("Location: Doctor_dashboard.php.php");
}
if (isset($_GET['Booking_id'])) {
    $Booking_id = $_GET['Booking_id'];

    // Fetch the prescription details from the database
    $selectQuery = "SELECT * FROM patient_booking WHERE Booking_id = $Booking_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $patient_booking = $result->fetch_assoc();


        // Note: Display the form for editing based on the fetched details
        // You may use JavaScript to show/hide the form or redirect to an edit page
    } else {
        echo "Booking not found";
    }
} else {
    echo "Invalid Booking ID";
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
        <h2>EDIT Booking</h2>
        <input type="hidden" name="Booking_id" value="<?php echo $patient_booking['Booking_id']; ?>">
        <table>
            <tr>
                <td><label for="Doc_id">Doctor id</label></td>
                <td><input type="text" id="Doc_id" name="Doc_id" disabled value="<?php echo $patient_booking['Booking_id']; ?>" ></td>
            </tr>
          
            <tr>
                <td><label for="Patient_id">Patient id:</label></td>
                <td><input type="text" id="Patient_id" name="Patient_id" disabled value="<?php echo $patient_booking['Patient_id']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Booking_status">Booking status:</label></td>
                <td>
                        <select  id="Booking_status" name="Booking_status"  required>
                                <option value="">--Select--</option>
                                <option value="Queued" disabled>Queued</option>
                                <option value="Seen"> Seen </option>
                        </select>
                    </td>
            </tr>
            <tr>
                <td><label for="Booking_date">Booking date:</label></td>
                <td><input type="datetime-local" id="Booking_date" name="Booking_date" disabled value="<?php echo $patient_booking['Booking_date']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Record</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this record?');">Delete Record</button>
        <button><a href="Doctor_dashboard.php">Back</a></button> </h2>
    </form>
</body>
