

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login</title>

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


$con = mysqli_connect($host,$username,$password,$dbname)
        or die("<br> Cannot connect to DB:$dbname on $host");
$busername=strtolower($_POST['login-name']);
$bpassword=$_POST['login-pass'];
//$hpassword = hash("sha256", $bpassword);


$sql="SELECT * FROM Staff WHERE username ='$busername'";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);

if(mysqli_num_rows($result)){
    if(strtolower($row['username']==$busername && $row['pword']!=$bpassword)){
        echo "<br> Employee ".$row['fname']." exists, but password incorrect.<br> Login Unsuccessful!\n";
    }
    elseif(strtolower($row['username'])==$busername && $row['pword']==$bpassword){
        $name = $row['fname'];
        $role = $row['Srole'];
        $id = $row['StaffID'];
        setcookie("staff_name",$name,time()+3600);
        setcookie("staff_role", $role, time()+3600);
        setcookie("staff_id", $id, time()+3600);



if($role == "A"){
            $role="Admin";
            echo"
            <body>

                <div class='login'>
                    <div class='login-screen'>
                    <div class='app-title'>
                    <h2>Staff Dashboard</h2>
                </div>

 
                    </div>
                </div>
            </body>
            
            ";
            echo "<br> Welcome $role : $name </b>
                  <br><a href='staff_logout.php'>$role logout</a>
                  <br><br>
                <h1>User Management</h1>
                  <a href='CPS5301_add_user.php'>Add User</a>
                  <a href='manage_users.php'>Manage Users</a>
                  <a href='text_editor.php'>Add Article</a>
                  <br> ";


        }
        elseif($role=="M"){
            $role = "Moderator";
            echo"
            <body>

                <div class='login'>
                    <div class='login-screen'>
                    <div class='app-title'>
                    <h2>Staff Dashboard</h2>
                </div>

 
                    </div>
                </div>
            </body>
            
            ";
            echo "<br> Welcome $role :<b> $name </b>
                  <br><a href='staff_logout.php'>$role logout</a>
                  <br><br>

                <h1>User Management</h1>
                  <a href='#.php'>View Feedback</a>
                  <a href='mod_article.php'>Moderate Articles</a>
                  <a href='text_editor.php'>Add Article</a>
                  <br>
                  <br> ";
        }
    }
}
    else{
        echo "<br>".$busername." doesn't exist in the database. <br> Login Failed!\n";
    }

    mysqli_close($con);
?> 