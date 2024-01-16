

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

if((isset($_COOKIE['staff_role'])) &&($_COOKIE['staff_role']=='A')){
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
          <a href='CPS5301_add_user.php'>Add Users</a>
          <a href='staff_dashboard.php'>$role Dashboard</a>
          <br> ";
          echo "<form name = 'input_users' action ='delete_user.php' method= 'post'>";
          echo "The following users are in the database: <br>";
          echo "<TABLE class='styled-table' border=1>\n";
          echo "<TR><TH>UserID<TH>FirstName<TH>LastName<TH>Email<TH>Username<TH>D.O.B<TH>AccountType<TH>Delete</TR>";
          while($row=mysqli_fetch_array($result)){
              $uid=$row['uid'];
              $fname=$row['fname'];
              $lname=$row['lname'];
              $email=$row['email'];
              $uname=$row['username'];
              $dob=$row['dob'];
              $atype=$row['role'];

              echo "<TR class='active-row'><TD>$uid<TD><a href='#'>$fname</a><TD>$lname<TD>$email<TD>$uname<TD>$dob<TD>$atype<TD><a href='delete_user.php?delete_id=$uid';>Delete user </a></TR>";
          }
          echo "</TABLE>\n";
          echo "<br><br>";


}else{
	echo "You must be logged in as admin to manage users. <br>";

	die;
}

mysqli_close($con);
?> 