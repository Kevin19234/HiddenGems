

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Logout</title>

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

if(!isset($_COOKIE['staff_name'])){
	echo "You successfully logout<br>";
	echo "<br>You will be redirected to HiddenGem's home page in 3 seconds...";
	header("refresh:3;url=index.php");
	die;
}else{
	echo "You successfully logged out<br>";
	echo "<br>You will be redirected HiddenGem's home page in 3 seconds...";
	header("refresh:3;url=index.php");
	unset($_COOKIE['Employee_name']);
	unset($_COOKIE['Employee_role']);
	unset($_COOKIE['Employee_id']);
	setcookie("staff_name","",time()-3600);
	setcookie("staff_role","",time()-3600);
	setcookie("staff_id","",time()-3600);
	die;
}

?> 