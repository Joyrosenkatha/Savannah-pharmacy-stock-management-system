<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Add Prescription </title>
        <link rel="stylesheet" href="style.css" />
       

    </head>
    <body>
        <?php include('Pharmacist_sidemenu.php');?>

        <div class="main--content">
         <div class="header--wrapper">
        <div class="header--title">
                <a href="#">
                    
                  <span>Savannah Hospital</span>
                </a>
            
            <h2>Pharmacist Dashboard</h2>
        </div>
        <div class="user--info">
            <div class="search--box">
                
                <input type="text" placeholder="search here" />
            </div>
            <img src="user.jpg" alt="" />
        </div>
         </div>  
         <div class="card--container">
            <h3 class="main--title">Dispensation details</h3>
            <div class="card--wrapper">
            <form name="Dispensation_form" method="POST"> 
            <div class="input-group">
                <div class="input-field">
                    
                    <input type="text" placeholder="Med_id">
                </div>

                <div class="input-field">
                    
                    <input type="text" placeholder="Quantity_dispensed">
                </div>
                
                <div class="input-field">
        
                    <input type="text" placeholder="Patient_id">
                </div>

                <div class="input-field">
            
                    <input type="text" placeholder="Dispensing_date">
                </div>

                <div class="input-field">
                    
                    <input type="text" placeholder="Dispensing_cost">
                </div>

                <div class="input-field">
                    
                    <input type="text" placeholder="Email">
                </div>

                <div class="input-field">
                    
                    <input type="text" placeholder="Address">
                </div>
                <div class="btn-field">
                    <button type="button" id="submit">Submit records</button>
                </div>
                </div>
            </form>