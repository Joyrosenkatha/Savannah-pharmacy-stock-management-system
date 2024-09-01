<?php 
//include statement is used to insert the content of one PHP file into another PHP file before the server executes it.
session_start();//starts a new session and stores user information across pages
    //establishes a connection to the database using the function mysqli_connect with the following parameters
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check if database connection was successful
    if (!$link) {//checks if connect link is false
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    //statement checks if the form has been submitted.
    //form the isset it checks if the submit button was clicked and the data was sent via a POST request. 
    if(isset($_POST['submit'])) {
        //the lines retrieve the values from the form fields sent via the POST request and assign them to corresponding PHP variables.
        $Patient_name = $_POST['Patient_name'];
        $Gender = $_POST['Gender'];
        $DateOfBirth = $_POST['DateOfBirth'];
        $Phone_Number =$_POST['Phone_Number'];
        $National_id =$_POST['National_id'];
        $Email =$_POST['Email'];
        $Address =$_POST['Address'];
        $City =$_POST['City'];

        //validate DOB
        $date = new DateTime($DateOfBirth); 
        $now = new DateTime();        
        if($date < $now) {
            //proceed            
        }else{
            header("Location: AddNewPatient.php?error=Invalid Date of birth");           
            die();
        }
       
        //the line constructs an SQL query to insert a new record into the patients_table in the db
        // The values being inserted come from the PHP variables that were assigned from the form inputs.
        $sql ="INSERT INTO patients_table (Patient_name, Gender, DateOfBirth, Phone_Number, National_id, Email, Address, City)
        VALUES ('$Patient_name', '$Gender', '$DateOfBirth', '$Phone_Number', '$National_id', '$Email' ,' $Address' , '$City')";
//It checks if the query execution is successful by executing the SQL query using the query method of the $link 
        if ($link->query($sql) === TRUE) {
            //echo statement is used to output one or more strings.
            echo "Record added successfully";
            //Redirects the user to the file using the function header which sends a HTTP header to the client that effectively redirects the browser to another page.
            header("Location: AddNewPatient.php");
            exit();
     //If the query execution fails an error message that includes the SQL query and the specific error message returned by the database
        } else {
            echo "Error: " .$sql . "<br>" . $link->error;
        }
    }
    
    include('healthinfo_sidemenu.php');
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Add Patient </title>
        <link rel="stylesheet" href="style.css" />
       

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
            
            <h2>Health Information Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                <input type="text" placeholder="search here" />
            </div>
            
            <img src="user.jpg" alt="" />
            <!--outputs the value stored in the $_SESSION['sessionUsername'] session variable, displays logged in user-->
            <?php  echo  $_SESSION['sessionUsername']; ?>
        </div>
         </div> 
         <!--table--container acts as a container for the table that will display the patient records.--> 
         <div class="table--container">
        <h3 class="main--title">Patient Registration</h3>
        <form name="patients_form" method="POST" action="AddNewPatient.php">
            <table>
                <tr>
                    <td><label for="Patient_name">Patient Name</label></td>
                    <td><input type="text" id="Patient_name" name="Patient_name" placeholder="Patient Name" required></td>
                </tr>
                <tr>
                    <td><label for="Gender">Gender</label></td>
                    <td><input type="text" id="Gender" name="Gender" placeholder="Gender" required></td>
                </tr>
                <tr>
                    <td><label for="DateOfBirth">Date of Birth</label></td>
                    <td><input type="text" id="DateOfBirth" name="DateOfBirth" placeholder="Date of Birth" required></td>
                </tr>
                <tr>
                    <td><label for="Phone_Number">Phone Number</label></td>
                    <td><input type="text" id="Phone_Number" name="Phone_Number" placeholder="Phone Number" required></td>
                </tr>
                <tr>
                    <td><label for="National_id">National Id</label></td>
                    <td><input type="text" id="National_id" name="National_id" placeholder="National id" required></td>
                </tr>
                <tr>
                    <td><label for="Email">Email</label></td>
                    <td><input type="text" id="Email" name="Email" placeholder="Email" required></td>
                </tr>
                <tr>
                    <td><label for="Address">Address</label></td>
                    <td><input type="text" id="Address" name="Address" placeholder="Address" required></td>
                </tr>
                <tr>
                    <td><label for="City">City</label></td>
                    <td><input type="text" id="City" name="City" placeholder="City" required></td>
                </tr>

                <tr>                    
                    <td><p style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];} ?></p></td>
                </tr>                
            </table>
            <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Health_information_dashboard.php">Go Back</a></button>
                    
       
                    </form>
    </body>
</html>