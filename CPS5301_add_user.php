

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-- Style Css Link -->
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <!-- Style Css Link -->

    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Awesome Cdn -->

    <!-- Google Font links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
</head>


</html>

<?php
include "nav.php"; 
include "dbconfig.php";

if(isset($_COOKIE['staff_name'])){
    $name = $_COOKIE['staff_name'];
    $Srole = $_COOKIE['staff_role'];
    $login_id = $_COOKIE['staff_id'];

    if ($Srole ='A'){
        $role = 'Admin';


    }else{
        $role ='Manager';}

    echo"
    <body>

        <div class='login'>
            <div class='login-screen'>
            <div class='app-title'>
            <h2>User Management</h2>
        </div>


            </div>
        </div>
    </body>
    
    ";

    $con = mysqli_connect($host,$username,$password,$dbname)
    or die("<br> Cannot connect to DB:$dbname on $host");

$sql = "SELECT * FROM hg_users";

$result = mysqli_query($con,$sql);

//		$row = mysqli_fetch_array($result);
//		$login_id = $row['username'];
    echo "<br> Welcome $role : $name </b>
          <br><a href='staff_logout.php'>$role logout</a>
          <a href='manage_users.php'>Manage Users</a>
          <a href='staff_dashboard.php'>$role Dashboard</a>
          <br> ";

          echo "<HTML>";
          echo "<h3> Add User </h3>";
          echo "<form name= 'Add_Traveler' action= 'add_traveler.php' method= 'post'>";
          echo "<input type = 'hidden' name= 'staff_id' value='$login_id'>";
          echo "Login ID: <input type= 'text' name= 'username' required= 'required'> <br>";
          echo "<br> Password: <input type= 'password' name= 'password' required= 'required'><br>";
          echo "<br> Email: <input type= 'text' name= 'email' required= 'required'><br>";
          echo "<br> First Name: <input type= 'text' name= 'fname' required= 'required'><br>";
          echo "<br> Last Name: <input type='text' name='lname' required='required'><br>";
          echo "<br> D.O.B: <input type='date' id='birthdate' name='birthdate' min=1920-01-01' max='2024-12-31'><br><br>";
          echo "<br>Account Type: <select  name ='accountType' id ='accountType'  placeholder='Select one' maxlength='55' required>
          <option value='Traveler'>Traveler</option>
          <option value='Contributor'>Contributor</option>
          <option value='Business'>Business</option>
          </select><br><br>";

          echo "<input type='submit' name= 'submit-traveler' value= 'Add User'><br><br>";
          echo "</form>";

          echo "<h3> Add Staff </h3>";
          echo "<form name= 'Add_Staff' action= 'add_staff.php' method= 'post'>";
          echo "<input type = 'hidden' name= 'staff_id' value='$login_id'>";
          echo "Login ID: <input type= 'text' name= 'username' required= 'required'> <br>";
          echo "<br> Password: <input type= 'password' name= 'password' required= 'required'><br>";
          echo "<br> Email: <input type= 'text' name= 'email' required= 'required'><br>";
          echo "<br> First Name: <input type= 'text' name= 'fname' required= 'required'><br>";
          echo "<br> Last Name: <input type='text' name='lname' required='required'><br>";
          echo "<br> D.O.B: <input type='date' id='birthdate' name='birthdate' min=1920-01-01' max='2024-12-31'><br><br>";
          echo "<br>Account Type: <select  name ='Srole' id ='accountType2'  placeholder='Select one' maxlength='50' required>
          <option value='M'>Moderator</option>
          <option value='A'>Administrator</option>
          </select><br><br>";

          echo "<input type='submit' name= 'submit-staff' value= 'Add Staff'><br><br>";
          echo "</form>";
          echo "</HTML>";


}else{
	echo "You must be logged in to add a user. <br>";

	die;
}
mysqli_close($con);

?> 

<?php include "footer.php";


?>