<?php


// Include database connection and authentication files
include('conn.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="10x16" href="../Savannah-icon.png">
    <title>Savanna | Users Logs </title>

    
</head>

<script>
   
    function editUser(UserId) {
        // Redirects to the PHP script that handles the edit operation
        window.location.href = 'Edit_user.php?User_id=' + UserId;
    }
</script>

<body>
    
<style>
/* Style for form container */
*{
    margin:5;
    padding: 0;
    outline: 0;
    appearance: none;
    border: 0;
    text-decoration: none;
    list-style: none;
    box-sizing: border-box;
}
img{ 
    max-width: 50px;
    gap: 1rem;
}
body{
    width: 100vw;
    height: 100vh;
    font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size: 0.88rem;
    background: var(--color-background);
    
    overflow-x: hidden ;
    color: var(--color-dark);

}
nav{
    background-color: rgba(113, 99, 186, 255);
    width: 100vw;
    height:5rem ;
    position: fixed;
    top: 0;
    z-index: 21;
    color:#fff;
    
}

.nav__container{
    height: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
nav button{
    display: none;
}
.nav__menu{
    display: flex;
    align-items: center;
    gap: 3rem;
}
.nav__menu a{
    font-size: 1rem;
    transition: var(--transition);
    align-items: center;
    padding-left: 15%;
    color: #fff;
    text-transform: uppercase;
}
.nav__menu a:hover{
    color: #ff7782;
}

form {
    display: flex;
    flex-direction: row;
    width: 100%;
    margin: 20px auto;
    text-align: center;
    align-items: center;
}

/* Style for form labels */
label {
    margin-bottom: 5px;
    padding-left: 0%;
    width: 103%;
}

/* Style for form inputs */
input ,
textarea,
select{
    padding: 8px;
    margin-bottom: 10px;
    width: 10%;
    box-sizing: border-box;
    background-color:  #CBC3E3;
    border-radius: 5px;
}
/* Style for the submit button */
button {
    background-color: rgba(113, 99, 186, 255);
    color: #fff;
    padding: 7px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    gap: 3px;
    right: 0;
}

/* Style for User table */
#usersTable {
    width: 98%;
    
    margin-top: 20px;
}

/* Style for table headers */
#usersTable th {
    background-color: rgba(113, 99, 186, 255);
    color: #fff;
    padding: 10px;
}

/* Style for table cells */
#usersTable td {
    border: 1px solid #ddd;
    padding: 8px;
}

/* Style for new users */
#addUser {
    text-align: center;
    margin-top: 5px;
}

/* Style for users information container */
#usersInformation {
    text-align: center;
    margin-top: 30px;
}
marquee{
    border-radius: var(--border-radius-1);
    height: 30px;
    text-align: center;
    font-size:x-large;
    margin-top: 0;
    background-color: var(--color-danger);
}
.user-h1 h1{
    
    text-align: center;
    margin-top: 50px;
    margin-right: 10%;
}
.danger{
    color: #ff7782;
}
.active{
    color: #000;
}
h2{
    align-items: center;
    padding-left: 45%;

}


/* Style for hidden class */

</style>  
<nav>
            
            <div class="container nav__container">
            <ul class="nav__menu">
            <img src="../Savannah-icon.png">
                                <a href="Admin_dashboard.php" >
                                    <h3>Dashboard</h3>
                                </a>
                              
            
                                <a href="Users.php">
                                    <h3 class="active">Users</h3>
                                </a>
            
                                <a href="AddUser.php" >
                                    <h3>Add New User</h3>
                                </a>
                            
                                <a href="Admin_dashboard.php">
                                    <h3>Logout</h3>
                                </a>  
            </ul>    
                        </div>
                
                    </nav>


</head>
                <body>      
            <div class="user-h1">
                       <h1>SAVANNAH- <span class="danger">USER INFORMATION</span></h1>
                    </div>

            <h2>User Record</h2>
            
            <table id="user_table">
                
                <div id="usersInformation">
                <table id="usersTable">
                    <!-- Search bar form -->
<form method="GET" action="">
    <input type="text" name="search_query" placeholder="Search by user name, Mobile number, or Email">
    <button type="submit" name="search">Search</button>
    <button type="submit" name="search">Refresh</button>
</form>
<thead>
                    <tr>
                        <th>User Id</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>User role</th>
                        <th>Mobile number</th>
                        <th>Log Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

// Initialize $result
$result = null;

// Check if the search form is submitted
if(isset($_GET['search'])) {
    // Get the search query from the form
    $search_query = $_GET['search_query'];
    
  // Fetch and display the user records from the database based on the search query parameters provided
  $sql = "SELECT * FROM users_table WHERE Username LIKE '%$search_query%' OR Mobile_number LIKE '%$search_query%' OR Email LIKE '%$search_query%'";

  // Get result
  $result = $link->query($sql);
  
  // Check if there are any results from the database
  if($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["User_id"] . "</td>";
          echo "<td>" . $row["Full_name"] . "</td>";
          echo "<td>" . $row["Username"] . "</td>";
          echo "<td>" . $row["Email"] . "</td>";
          echo "<td>" . $row["User_role"] . "</td>";
          echo "<td>" . $row["Mobile_number"] . "</td>";
          echo "<td>" . $row["Log_time"] . "</td>";
          echo "<td><button onclick=\"editUser('{$row['User_id']}')\">Update</button>";
          echo "</tr>";
        }
       
        exit();
    } else {
        // No results found
        echo "<tr><td colspan='14' style='color: red;'>No results found.</td></tr>";

    }

} 



                // Fetch and display users records from the database
        $result = $link->query("SELECT * FROM users_table");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["User_id"] . "</td>";
          echo "<td>" . $row["Full_name"] . "</td>";
          echo "<td>" . $row["Username"] . "</td>";
          echo "<td>" . $row["Email"] . "</td>";
          echo "<td>" . $row["User_role"] . "</td>";
          echo "<td>" . $row["Mobile_number"] . "</td>";
          echo "<td>" . $row["Log_time"] . "</td>";
            echo "<td><button onclick=\"editUser('{$row['User_id']}')\">Update</button>";
            echo "</tr>";
        }
        ?>

                </tbody>
            </table>
        
           
            </div>
    </div>
         
        </body>
        </html>
