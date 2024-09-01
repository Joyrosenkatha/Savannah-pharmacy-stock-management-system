<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Health information Dashboard </title>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
        

    </head>
    <body>
    <div class="sidebar">
            <div class="logo"></div>
            <ul class="menu">
                <li class="active">
                    <a href="#">
                        <a href="Health_information_dashboard.php"><span>Dashboard</span></a>
                    </a>
                </li>
                
                <li>
                    <a href="#">
                        <a href="AddNewPatient.php"><span>Add New Patient</span></a>
                    </a>
                </li>
                <li>
                    <a href="#">
                    
                        <a href="PatientsList.php"><span>Patients' List</span></a>
                    </a>
                </li>
                <li>
                    <a href="#">
                    
                        <a href="NewBooking.php"><span>Add New Booking</span></a>
                    </a>
                </li>
                <li>
                    <a href="#">
                    
                        <a href="BookingList.php"><span>Booking List</span></a>
                    </a>
                </li>
                <li class="logout">
                    <a href="#">
                        <a href="logout.php"><span>Logout</span></a>
                    </a>
                </li>
            </ul>
        </div>

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
            <?php session_start(); echo  $_SESSION['sessionUsername']; ?>

        </div>
         </div>   
         <div class="card--container">
            <div class="main-cards">
         <div class="cards">
                    <div class="card-inner">
                        <h3>PATIENT</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="PatientsReport.php">Visit</a></button>
                </div>    
         <div class="cards">
                    <div class="card-inner">
                        <h3>ADD NEW PATIENT</h3>
                    </div>
                    <button><a href="AddNewPatient.php">Visit</a></button>
                </div>  
                <div class="cards">
                    <div class="card-inner">
                        <h3>Booking</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="BookingsReport.php">Visit</a></button>
                </div>      
        </div>
    </body>
</html>