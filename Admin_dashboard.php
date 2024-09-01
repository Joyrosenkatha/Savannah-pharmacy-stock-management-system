
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Admin Dashboard </title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">


</head>
    <body>
    <?php include('Admins_sidemenu.php');?>
    <div class="card--container">
            
    </div>
    <div class="main--content">
    <?php include('admin_header.php');?>

        <div class="card--container">
            <div class="main-cards">
                <div class="cards">
                    <div class="card-inner">
                        <h3>MEDICINE</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="medicine_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>Booking</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="adminBooking_reports.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>PATIENT</h3>
                        <span class="">Reports</span>
</div>
                    <button><a href="patient_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>ORDER</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="order_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>PRESCRIPTION</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="prescription_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>DISPENSATION</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="dispensation_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>STOCK</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="Stock_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>SUPPLIER</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="supplier_report.php">Visit</a></button>
                </div>
                <div class="cards">
                    <div class="card-inner">
                        <h3>USER</h3>
                        <span class="">Reports</span>
                    </div>
                    <button><a href="user_report.php">Visit</a></button>
                </div>
            </div>
        </div>
        
            
    </div>
    </body>
</html>
