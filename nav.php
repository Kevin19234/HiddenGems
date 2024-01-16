<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidden Gem Homepage</title>

    <!-- Style Css Link -->
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Style Css Link -->

    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Awesome Cdn -->

    <!-- Google Font links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<!-- Header Start -->
<?php if(!isset($_COOKIE['logged_in'])){
    echo "
<div class='header'>
        <nav>

            <input type='checkbox' id='show-search'>
            <input type='checkbox' id='show-menu'>
            <label for='show-menu' class='menu-icon'><i class='fas fa-bars'></i></label>

            <div class='content'>

                <div class='logo'>
                    <div class='logo'><a href='index.php'><img src='./images/hiddengem.png' alt=''></a></div>
                </div>
                <ul class='links'>
                    <li><a href='index.php'>Home</a></li>
                    <li><a href='map.php'>View Map</a></li>
                    <li><a href='about_us.php'>About</a></li>
                    <li><a href='contact.php'>Contact</a></li>
                    <li><a href='login.php'>Log in/Sign up</a></li>
                    <li><a href='staff_login.php'>Staff</a></li>
                </ul>
            </div>
            <label for='show-search' class='search-icon'><i class='fas fa-search'></i></label>
            <form action='search.php' class='search-box'>
                <input type='text' placeholder='Search' name='search_items' required>
                <button type='submit' class='go-icon'><i class='fas fa-long-arrow-alt-right'></i></button>
            </form>


        </nav>
    </div>
     ";}

    elseif(isset($_COOKIE['logged_in'])){
        echo "
        <div class='header'>
        <nav>

            <input type='checkbox' id='show-search'>
            <input type='checkbox' id='show-menu'>
            <label for='show-menu' class='menu-icon'><i class='fas fa-bars'></i></label>

            <div class='content'>

                <div class='logo'>
                    <div class='logo'><a href='index.php'><img src='./images/hiddengem.png' alt=''></a></div>
                </div>
                <ul class='links'>
                    <li><a href='index.php'>Home</a></li>
                    <li><a href='map.php'>View Map</a></li>
                    <li><a href='about_us.php'>About</a></li>
                    <li><a href='contact.php'>Contact</a></li>
                    <li><a href='profile.php'>User Dash Board</a></li>
                </ul>
            </div>
            <label for='show-search' class='search-icon'><i class='fas fa-search'></i></label>
            <form action='search.php' class='search-box'>
                <input type='text' placeholder='Search' name='search_items' required>
                <button type='submit' class='go-icon'><i class='fas fa-long-arrow-alt-right'></i></button>
            </form>


        </nav>
    </div>
         ";} ?>
    <!-- Header End -->
</body>
</html>