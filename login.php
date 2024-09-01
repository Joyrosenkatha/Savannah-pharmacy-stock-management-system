
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <title>Hospital pharmacy stock management system</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <div class="wrapper">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
        <section>
            <center>
                <header>
                    
                    Login Form
                </header>
            </center>
            <!--Login form begins-->
            <form action="connect.php" method="post"> 
                <div class="input-field">
                    
                    <label for="">Username</label>
                    <input type="text" name="username"
                    placeholder="Kindly provide your Username">
                </div>

                <div class="input-field">
                    
                    <label for="">Password</label>
                    <input type="password" name="password"
                    placeholder="Kindly provide your password">
                </div>
                <div class="field button">
                    <input type="submit" name="login_form" value="LOGIN">
                    <br>
                    <button><a href="Homepage.php">Go Back</a></button>
                </div>
                <div class="error-message" >
                <?php
                    if(isset($_GET['error'])){
                        echo $_GET['error'];                            
                    }                        
                ?>
                </div>
                <a href="register.php" class="link">Register Here..</a>
            </form>
            <!--end of Login-->
            
            
        </section>
    </div>           
    </body>
</html>
                