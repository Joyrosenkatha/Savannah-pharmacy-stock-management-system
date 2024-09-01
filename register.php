<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <title>Hospital pharmacy stock management system</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <!--Wrapper-->

    <div class="wrapper">
        <section>
            <center>
                <header>
                    User Registration Form
                </header>
            </center>
            <!--Login form begins-->
            <form action="connect.php" method="post"> 
                <div class="input-field">
                    
                    <label for="">Full_name</label>
                    <input type="text" name="Full_name"  placeholder="Kindly fill in your full_name" required>
                </div>
                <div class="input-field">
                    
                    <label for="">Username</label>
                    <input type="text" name="Username"  placeholder="Kindly provide your Username" required>
                </div>
                <div class="input-field">
                    
                    <label for="">Gender</label>
                    <select name="Gender" required>
                        <option value="">--Select --</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    
                </div>
                <div class="input-field">
                    
                    <label for="">Email</label>
                    <input type="email" name="Email" placeholder="Kindly provide your email" required>
                </div>
                <div class="input-field">
                    
                    <label for="">Date of Birth</label>
                    <input type="text" name="DOB" placeholder="Kindly provide your DOB" required>
                </div>

                <div class="input-field">
                    
                    <label for="">User_role</label>
                    <select name="User_role" required>
                        <option value="">--Select --</option>
                        <option>Admin</option>
                        <option>Doctor</option>
                        <option>Receptionist</option>
                        <option>Pharmacist</option>
                    </select>
                </div>
                <div class="input-field">
                    
                    <label for="">Mobile Number</label>
                    <input type="text" name="Mobile_number"
                    placeholder="Kindly provide your Mobile_number">
                </div>
                <div class="input-field">
                    
                    <label for="">Password</label>
                    <input type="password" name="Password"
                    placeholder="Kindly provide your password">
                </div>
                <div class="input-field">
                    
                    <label for="">Confirm password</label>
                    <input type="password" name="Confirm_password"
                    placeholder="Kindly confirm your password">
                </div>
        
                <div class="field button">
                    <input type="submit" name="registration_form" value="REGISTER">
                </div>
                <div class="error-text">
                    <?php
                        if(isset($_GET['error'])){
                            echo $_GET['error'];                            
                        }                        
                    ?>
                </div>


                <a href="login.php" class="link">Login Here..</a>
            </form>
            <!--end of Login-->
          
            
        </section>
    </div>
    <!--Wrapper-->             
    </body>
</html>
                