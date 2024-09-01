<?php include('Admins_sidemenu.php');
session_start();
    $link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

    //To check for error
    if (!$link) {
        //die stops the script from being executed
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit'])) {
        $Full_name = $_POST['Full_name'];
        $Username = $_POST['Username'];
        $Gender = $_POST['Gender'];
        $Email = $_POST['Email'];
        $DOB = $_POST['DOB'];
        $User_role = $_POST['User_role'];
        $Password =$_POST['Password'];
        $Mobile_number =$_POST['Mobile_number'];
        $Confirm_password =$_POST['Confirm_password'];
      
       // Date validation
       $dob_parts = explode('-', $DOB);
       if (count($dob_parts) !== 3 || !checkdate($dob_parts[1], $dob_parts[2], $dob_parts[0])) {
           header("Location: AddUser.php?error=invalid_dob");
           exit();
       }

       $dob_year = intval($dob_parts[0]);
       $current_year = intval(date('Y'));
       if ($dob_year < 1900 || $dob_year > $current_year - 18) {
           header("Location: AddUser.php?error=invalid_dob");
           exit();
       }
        //Insert into database
        $sql ="INSERT INTO users_table (Full_name, Username, Gender, Email, DOB, User_role, Mobile_number, Password, Confirm_password)
        VALUES ('$Full_name', '$Username', '$Gender', '$Email', '$DOB', '$User_role', '$Mobile_number', '$Password', 'Confirm_password')";

        if ($link->query($sql) === TRUE) {
            echo "Record added successfully";
            header("Location: AddUser.php");
            exit();
        } else {
            echo "Error: " .$sql . "<br>" . $link->error;
        }
    }
    
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Add User </title>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
        

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
            
            <h2>Admin Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                
                <input type="text" placeholder="search here" />
            </div>
            <img src="user.jpg" alt="" />
            <?php  echo  $_SESSION['sessionUsername']; ?>

        </div>
         </div>  
         <div class="table--container">
    <h3 class="main--title">User details</h3>
    <form name="user_form" method="POST" action="AddUser.php">
        <table>
            <tr>
                <td><label for="Full_name">Full Name</label></td>
                <td><input type="text" id="Full_name" name="Full_name" placeholder="Full Name" required></td>
            </tr>
            <tr>
                <td><label for="Username">Username</label></td>
                <td><input type="text" id="Username" name="Username" placeholder="Username" required></td>
            </tr>
            <tr>
                <td><label for="Gender">Gender</label></td>
                <td><input type="text" id="Gender" name="Gender" placeholder="Gender" required></td>
            </tr>
            <tr>
                <td><label for="Email">Email</label></td>
                <td><input type="text" id="Email" name="Email" placeholder="Email" required></td>
            </tr>
            <tr>
                <td><label for="DOB">Date of Birth</label></td>
                <td><input type="text" id="DOB" name="DOB" placeholder="Date of Birth" required></td>
            </tr>
            <tr>
                <td><label for="User_role">User Role</label></td>
                <td><input type="text" id="User_role" name="User_role" placeholder="User Role" required></td>
            </tr>
            <tr>
                <td><label for="Mobile_number">Mobile Number</label></td>
                <td><input type="text" id="Mobile_number" name="Mobile_number" placeholder="Mobile Number" required></td>
            </tr>
            <tr>
                <td><label for="Password">Password</label></td>
                <td><input type="password" id="Password" name="Password" placeholder="Password" required></td>
            </tr>
            <tr>
                <td><label for="Confirm_password">Confirm Password</label></td>
                <td><input type="password" id="Confirm_password" name="Confirm_password" placeholder="Confirm Password" required></td>
            </tr>
            
        </table>
        <div class="button-container">
            <button type="submit" name="submit">Submit</button>
                    <button><a href="Users.php">Go Back</a></button>
                    </form>
    
</body>
</html>