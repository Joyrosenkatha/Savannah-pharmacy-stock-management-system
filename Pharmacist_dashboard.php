<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Pharmacist Dashboard </title>
        <link rel="stylesheet" href="style.css" />
        <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
       

    </head>
    <body>
    <?php include('Pharmacist_sidemenu.php');?>


        <div class="main--content">
         <div class="header--wrapper">
        <div class="header--title">
                <a href="#">
                <img src="../Savannah-icon.png">
            <br>
                  <span>Savannah Hospital</span>
                </a>
            
            <h2>Pharmacist Dashboard</h2>
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
                        <h3>PRESCRIPTION </h3>
                        <span class="">Reports</span>
</div>
                    <button><a href="PrescriptionsReport.php">Visit</a></button>
                </div> 
                <div class="cards">
                    <div class="card-inner">
                        <h3>DISPENSATION</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="Dispensations_Report.php">Visit</a></button>
                </div> 
                <div class="cards">
                    <div class="card-inner">
                        <h3>STOCK</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="StocksReport.php">Visit</a></button>
                </div>      
        </div>
    </body>
</html>