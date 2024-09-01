<?php
/* A link variable that is used later in the code to connect to the database
mysqli_connect- This a method used to establish the connection and the connection
is assigned to the link variable.
mysqli_connect requires four arguments that is the database host machine,
the user password and the database name.
*/
$link = mysqli_connect("localhost", "joynkatha", "nkatha", "hospital_pharmacy_stock_management_system_database");

if (!$link) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
/*
  1.To check if the submit button is clicked
  2.$POST is a php array it captures/harvests data that is posted using the POST method
 */

// Check if the registration form is submitted
if (isset($_POST['registration_form'])) {
    $full_name = $_POST['Full_name'];
    $email = $_POST['Email'];
    $username = $_POST['Username'];
    $gender = $_POST['Gender'];
    $DOB = $_POST['DOB'];
    $user_role = $_POST['User_role'];
    $mobile_number = $_POST['Mobile_number'];
    $password = $_POST['Password'];
    $confirm_password = $_POST['Confirm_password'];
/*
    // Error handlers
    if (empty($username) || empty($password) || empty($user_role)) {
        header("Location:../register.php?error=empty_fields");
        exit();
    } elseif (!ctype_alnum($username)) {
        header("Location: register.php?error=invalid_username");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?error=invalid_email");
        exit();
    } elseif (strlen($password) < 8 || !has_digit($password) || !has_special_char($password)) {
        header("Location: register.php?error=weak_password");
        exit();
    } elseif ($password !== $confirm_password) {
        header("Location: register.php?error=password_mismatch");
        exit();
    } else {
        // Date validation
        $dob_parts = explode('-', $DOB);
        if (count($dob_parts) !== 3 || !checkdate($dob_parts[1], $dob_parts[2], $dob_parts[0])) {
            header("Location: register.php?error=invalid_dob");
            exit();
        }

        $dob_year = intval($dob_parts[0]);
        $current_year = intval(date('Y'));
        if ($dob_year < 1900 || $dob_year > $current_year - 18) {
            header("Location: register.php?error=invalid_dob");
            exit();
        }
*/
        // Check if the username is taken
        $sql = "SELECT username FROM users_table WHERE username = '$username'";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            header("Location: register.php?error=username_taken");
            exit();
        } else {
            // Hash the password
            $encrypted_password = md5($password);

            $sql = "INSERT INTO users_table (Full_name, Email, Username, Gender, DOB, Mobile_number, User_role, Password) 
                    VALUES ('$full_name', '$email', '$username', '$gender', '$DOB', '$mobile_number', '$user_role', '$encrypted_password')";
            if (mysqli_query($link, $sql)) {
                echo "Records added successfully.";
                header("Location: Login.php");
                die();
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
    }


// Check if the login form is submitted
if (isset($_POST['login_form'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $encrypted_password = md5($password);

    $sql = "SELECT * FROM users_table WHERE username='$username' AND Password='$encrypted_password'";
    $res = mysqli_query($link, $sql);
    $count = mysqli_num_rows($res);
    
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        session_start();
        $_SESSION['ROLE'] = $row['User_role'];
        $_SESSION['IS_LOGIN'] = 'yes';

        if ($row['User_role'] == 'Admin') {
            $_SESSION['sessionId'] = $row['User_id'];
            $_SESSION['sessionUsername'] = $row['Username'];
            header("Location: Dashboards/Admin_dashboard.php");
            die();
        } elseif ($row['User_role'] == 'Pharmacist') {
            $_SESSION['sessionId'] = $row['User_id'];
            $_SESSION['sessionUsername'] = $row['Username'];
            header("Location: Dashboards/Pharmacist_dashboard.php");
            die();
        } elseif ($row['User_role'] == 'Doctor') {
            $_SESSION['sessionId'] = $row['User_id'];
            $_SESSION['sessionUsername'] = $row['Username'];
            header("Location: Dashboards/Doctor_dashboard.php");
            die();
        } elseif ($row['User_role'] == 'Receptionist') {
            $_SESSION['sessionId'] = $row['User_id'];
            $_SESSION['sessionUsername'] = $row['Username'];
            header("Location: Dashboards/Health_information_dashboard.php");
            die();
        } else {
            $error = "<div class='alert alert-danger'>Please enter valid details</div>";
        }
    } else {
        header("Location: login.php?error=Invalid login credentials");
        exit();
    }
}

// Close connection
mysqli_close($link);


?>
