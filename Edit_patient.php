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

    $updateQuery = $link->query("UPDATE patients_table SET Patient_name =  '".$_POST['Patient_name']."', Gender =  '".$_POST['Gender']."', DateOfBirth =  '".$_POST['DateOfBirth']."', Phone_Number = '".$_POST['Phone_Number']."', Address ='".$_POST['Address']."', City = '".$_POST['City']."', Date_added =  '".$_POST['Date_added']."' WHERE Patient_id = ".$_POST['Patient_id']);
    

    header("Location: Patient.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM patients_table WHERE Patient_id = ".$_POST['Patient_id']);
    
    header("Location: Patient.php");
}

if (isset($_GET['Patient_id'])) {
    $Patient_id = $_GET['Patient_id'];

    // For getting the Patients records from the database
    $selectQuery = "SELECT * FROM patients_table WHERE Patient_id = $Patient_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $patients_table = $result->fetch_assoc();


    } else {
        echo "Patient not found";
    }
} else {
    echo "Invalid Patient ID";
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
        <h2>EDIT PATIENT</h2>
        <input type="hidden" name="Patient_id" value="<?php echo $patients_table['Patient_id']; ?>">
        <table>
            <tr>
                <td><label for="Patient_name">Patient Name:</label></td>
                <td><input type="text" id="Patient_name" name="Patient_name" value="<?php echo $patients_table['Patient_name']; ?>" required></td>
            </tr>
          
            <tr>
                <td><label for="Gender">Gender:</label></td>
                <td><input type="text" id="Gender" name="Gender" value="<?php echo $patients_table['Gender']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="DateOfBirth">Date Of Birth:</label></td>
                <td><input type="text" id="DateOfBirth" name="DateOfBirth" value="<?php echo $patients_table['DateOfBirth']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Phone_Number">Phone Number:</label></td>
                <td><input type="text" id="Phone_Number" name="Phone_Number" value="<?php echo $patients_table['Phone_Number']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Email">Email:</label></td>
                <td><input type="text" id="Email" name="Email" value="<?php echo $patients_table['Email']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Address">Address:</label></td>
                <td><input type="text" id="Address" name="Address" value="<?php echo $patients_table['Address']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="City">City:</label></td>
                <td><input type="text" id="City" name="City" value="<?php echo $patients_table['City']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Date_added">Date Added:</label></td>
                <td><input type="text" id="Date_added" name="Date_added" value="<?php echo $patients_table['Date_added']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Patient</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete Patient</button>
        <button><a href="Patient.php">Back</a></button> </h2>
    </form>
</body>