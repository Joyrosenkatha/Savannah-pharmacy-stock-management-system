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

    $updateQuery = $link->query("UPDATE doctors_table SET Doc_name =  '".$_POST['Doc_name']."', Specialization =  '".$_POST['Specialization']."', Doc_contact =  '".$_POST['Doc_contact']."', Date_added =  '".$_POST['Date_added']."' WHERE Doc_id = ".$_POST['Doc_id']);
    

    header("Location: Doctors.php");

}
if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM doctors_table WHERE Doc_id = ".$_POST['Doc_id']);
    
    header("Location: Doctors.php");
}

if (isset($_GET['Doc_id'])) {
    $Doc_id = $_GET['Doc_id'];

    // For getting the Medicine records from the database
    $selectQuery = "SELECT * FROM doctors_table WHERE Doc_id = $Doc_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $doctors_table = $result->fetch_assoc();


    } else {
        echo "Doctor not found";
    }
} else {
    echo "Invalid Doctor ID";
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
        <h2>EDIT DOCTOR</h2>
        <input type="hidden" name="Doc_id" value="<?php echo $doctors_table['Doc_id']; ?>">
        <table>
            <tr>
                <td><label for="Doc_name">Doctors Name:</label></td>
                <td><input type="text" id="Doc_name" name="Doc_name" value="<?php echo $doctors_table['Doc_name']; ?>" required></td>
            </tr>
          
            <tr>
                <td><label for="Specialization">Specialization:</label></td>
                <td><input type="text" id="Specialization" name="Specialization" value="<?php echo $doctors_table['Specialization']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Doc_contact">Doctors Contact:</label></td>
                <td><input type="text" id="Doc_contact" name="Doc_contact" value="<?php echo $doctors_table['Doc_contact']; ?>" required></td>
            </tr>
            <tr>
                <td><label for="Date_added">Date Added:</label></td>
                <td><input type="text" id="Date_added" name="Date_added" value="<?php echo $doctors_table['Date_added']; ?>" required></td>
            </tr>
        </table>
        <button type="submit" id="updatebtn" name="updatebtn" >Update Doctor</button>
        <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete Doctor</button>
        <button><a href="Doctors.php">Back</a></button> </h2>
    </form>
</body>