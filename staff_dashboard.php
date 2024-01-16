

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

if(isset($_COOKIE['staff_name'])){
        $login=$_COOKIE['staff_name'];
        $role = $_COOKIE['staff_role'];
        $id = $_COOKIE['staff_id'];
        $sql = "SELECT * FROM Staff WHERE fname ='$login'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);


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
            echo "<br> Welcome $role : $login 
                  <br><a href='staff_logout.php'>$role logout</a>
                  <br><br>
                <h1>User Management</h1>
                  <a href='CPS5301_add_user.php'>Add User</a>
                  <a href='manage_users.php'>Manage Users</a>
                  <h1>Content Management</h1>
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

                <h1>Content Management</h1>
                  <a href='#.php'>View Feedback</a>
                  <a href='mod_article.php'>Moderate Articles</a>
                  <a href='text_editor.php'>Add Article</a>
                  <br>
                  <br> ";
        }
    

    else{
        echo "<br>".$busername." doesn't exist in the database. <br> Login Failed!\n";
    }
}else{
    echo"<div class='login'>
    <div class='login-screen'>
        <div class='app-title'>
            <h1>Staff Login</h1>
        </div>

        <div class='login-form'>
            <div class='control-group'>
            <form name='input' action='staff_check.php' method='POST' >	
            <input type='text' class='login-field' value='' placeholder='username' name='login-name'>
            <label class='login-field-icon fui-user' for='login-name'></label>
            </div>

            <div class='control-group'>
            <input type='password' class='login-field' value='' placeholder='password' name='login-pass'>
            <label class='login-field-icon fui-lock' for='login-pass'></label>
            </div>

            <!-- This is a comment <a class='btn btn-primary btn-large btn-block' href='staff_dashboard.php'>Login</a>-->
            <button type='submit' class='btn btn-primary btn-large btn-block' id='submit-button'>Login</button>
            </form>

        </div>
    </div>
</div>";
}
    mysqli_close($con);
?> 