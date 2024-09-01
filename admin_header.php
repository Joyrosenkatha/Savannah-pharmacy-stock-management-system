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
                <br>
                <img src="user.jpg" alt="" />
                <?php session_start(); echo  $_SESSION['sessionUsername']; ?>

            </div>
        </div>