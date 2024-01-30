

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
          <a href='CPS5301_add_user.php'>Add More Users</a>
          <a href='manage_users.php'>Manage Users</a>
          <a href='staff_dashboard.php'>$role Dashboard</a>
          <br> ";

          if(isset($_POST['submit-staff'])){
            $staffid=$_POST['staff_id'];
            $login_name=$_POST['username'];
            $password=$_POST['password'];
            $email=$_POST['email'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $dob= $_POST['birthdate'];
            $accounttype2=$_POST['Srole'];
    
        
            $sql4= "SELECT * FROM 2023F_sanchem1.Staff WHERE username = '$login_name' ";
            $result1 = mysqli_query($con,$sql4);
            $count = mysqli_num_rows($result1);
    
        
            if($count>0){
                echo "login: ".$login_name." already exists! Enter a new Login.";

                die;
            }
        
            elseif($count==0){
                $sql3= "INSERT into 2023F_sanchem1.Staff(fname,lname,email,`Srole`,pword,username) 
                values('$fname','$lname','$email','$accounttype2','$password','$login_name')";
                $result2=mysqli_query($con,$sql3);
        
                if($result2){
                    echo "User successfully added!";

                }
                else{
                    echo "Error adding user..";
                    //echo mysqli_error($con); 
                    die;
                }
            }
            
        }	


}else{
	echo "You must be logged in as admin to add a user. <br>";

	die;
}

mysqli_close($con);
?> 