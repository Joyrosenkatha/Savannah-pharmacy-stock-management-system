<?php
$link = mysqli_connect("localhost", "root", "", "hospital_pharmacy_stock_management_system_database");

// To check for error
if (!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['updatebtn'])) {
    $updateQuery = $link->query("UPDATE users_table SET Full_name = '".$_POST['Full_name']."', Username = '".$_POST['Username']."', Gender = '".$_POST['Gender']."', Email = '".$_POST['Email']."', DOB = '".$_POST['DOB']."', User_role = '".$_POST['User_role']."', Password = '".$_POST['Password']."', Mobile_number = '".$_POST['Mobile_number']."', Log_time = '".$_POST['Log_time']."' WHERE User_id = ".$_POST['User_id']);
    
    header("Location: Users.php");
}

if (isset($_POST['deletebtn'])) {
    $deleteQuery = $link->query("DELETE FROM users_table WHERE User_id = ".$_POST['User_id']);
    
    header("Location: Users.php");
}

if (isset($_GET['User_id'])) {
    $User_id = $_GET['User_id'];

    $selectQuery = "SELECT * FROM users_table WHERE User_id = $User_id";
    $result = $link->query($selectQuery);

    if ($result->num_rows > 0) {
        $users_table = $result->fetch_assoc();
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid User ID";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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
    h2 {
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
    <h2>Edit User</h2>
    <input type="hidden" name="User_id" value="<?php echo $users_table['User_id']; ?>">
    <table>
        <tr>
            <td><label for="Full_name">Full Name:</label></td>
            <td><input type="text" id="Full_name" name="Full_name" value="<?php echo $users_table['Full_name']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="Username">Username:</label></td>
            <td><input type="text" id="Username" name="Username" value="<?php echo $users_table['Username']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="Gender">Gender:</label></td>
            <td><input type="text" id="Gender" name="Gender" value="<?php echo $users_table['Gender']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="Email">Email:</label></td>
            <td><input type="text" id="Email" name="Email" value="<?php echo $users_table['Email']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="DOB">Date Of Birth:</label></td>
            <td><input type="text" id="DOB" name="DOB" value="<?php echo $users_table['DOB']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="Password">Password:</label></td>
            <td><input type="text" id="Password" name="Password" value="<?php echo $users_table['Password']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="Mobile_number">Mobile number:</label></td>
            <td><input type="text" id="Mobile_number" name="Mobile_number" value="<?php echo $users_table['Mobile_number']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="Log_time">Log time:</label></td>
            <td><input type="text" id="Log_time" name="Log_time" value="<?php echo $users_table['Log_time']; ?>" required></td>
        </tr>
    </table>
    <button type="submit" id="updatebtn" name="updatebtn">Update User</button>
    <button type="submit" id="deletebtn" name="deletebtn" onclick="return confirm('Are you sure you want to delete this user?');">Delete User</button>
    <button><a href="Users.php">Back</a></button>
</form>
</body>
</html>
