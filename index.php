<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidden Gem Homepage</title>

    <!-- Style Css Link -->
    <link rel="stylesheet" href="./CSS/style.scss">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- Style Css Link -->

    <!-- Font Awesome Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Awesome Cdn -->

    <!-- Google Font links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500&display=swap" rel="stylesheet">
    <!-- api -->
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACdogbhXiQngWt9gDJslHH-vYjM-Hoq84&libraries=places&callback=initMap">
</script>
<link rel="stylesheet" href="https://pyscript.net/releases/2022.12.1/pyscript.css" />
    <script defer src="https://pyscript.net/releases/2022.12.1/pyscript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/serpapi@1.0.0/dist/google.js"></script>
</head>
<body>
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

        </nav>
    </div>
         ";} ?>
    <!-- Home Section Start -->
    <section class="home" id="home">
      <div class="w3-container">
        
        <div class="main-text">
            <div class="w3-panel w3-card-4 w3-black"><h3 style="font-family: 'Josefin Sans', sans-serif;">Find your next adventure in the Hidden Gems of New Jersey</h3></div>
    </div>
</div>
    <div class="wrap">
   <div class="search">
    <form style="width: 100%;"name="input" action="search.php" method="GET">
      <input type="text" name="search_items"class="searchTerm" placeholder="Please enter a zipcode, city name, or keyword" required>
      <button type="submit" class="searchButton" value="Search">
        <i class="fa fa-search"></i>
     </button>
     </form>
   </div>
</div>
    </section>
    <!-- Home Section End -->
<br>
<br>
   <!-- Blog Card Section Start -->
   <section>
   <h1 style="color: #1fc7d6;">Popular New Jersey Landmarks</h1>
    <br><br>
</section>
   <div class="cards">
  <a class="card">
    <div class="card-hero">
      <img src="./images/wildwood.jpeg" width="320" />
    </div>
    <div class="card-header">
      <h3>WildWood Beach</h3>
    </div>
    <div class="card-body">
      <p> Wildwood, New Jersey, is a vibrant and iconic resort town located on the southern tip of the Jersey Shore. Known for its expansive beaches, lively boardwalk, and classic Americana charm, Wildwood attracts visitors seeking a mix of sun, sand, and entertainment.</p><br>
        <p> The centerpiece of Wildwood is its famous boardwalk, stretching for over two miles along the beachfront. Lined with shops, amusement piers, eateries, and water parks, the boardwalk offers a nostalgic experience reminiscent of classic seaside destinations. Visitors can enjoy thrilling rides, play arcade games, savor traditional boardwalk treats like funnel cakes and saltwater taffy, or simply take a leisurely stroll with ocean views.</p>
        <br><br>
    </div>
  </a>
  <a class="card">
    <div class="card-hero">
      <img src="./images/atlantic.jpeg" width="320" />
    </div>
    <div class="card-header">
      <h3>Atlantic City</h3>
    </div>
    <div class="card-body">
      <p>Atlantic City, New Jersey, is a dynamic resort city located along the Atlantic Ocean that has earned a reputation as the "Las Vegas of the East Coast." Known for its vibrant nightlife, iconic boardwalk, and world-class casinos, Atlantic City is a popular destination for those seeking excitement and entertainment.</p><br>
        <p>Atlantic City's most famous attraction is its historic boardwalk, which stretches for four miles along the beachfront. The boardwalk is lined with shops, restaurants, and amusement piers, and visitors can enjoy a variety of activities, including shopping, dining, and people-watching. The boardwalk is also home to several casinos, including the Hard Rock Hotel & Casino, the Ocean Casino Resort, and the Tropicana Atlantic City.</p>
        <br>
    </div>
  </a>
  <a class="card">
    <div class="card-hero">
      <img src="./images/Paterson_falls.jpeg" width="320" />
    </div>
    <div class="card-header">
      <h3>The Patterson Falls</h3>
    </div>
    <div class="card-body">
      <p>Paterson Falls, located in the city of Paterson, New Jersey, is a breathtaking natural wonder that holds both historical and scenic significance. These falls are the second-largest waterfall by volume east of the Mississippi River and have played a crucial role in the region's industrial history.</p><br>
        <p>Paterson Falls is a 77-foot waterfall located on the Passaic River in the heart of Paterson, New Jersey. The falls are located in the Great Falls Historic District, which is a National Historic Landmark District and a National Park Service National Historical Park. The falls are a popular destination for visitors seeking a scenic escape from the city, and the surrounding park offers a variety of recreational activities, including hiking, biking, and picnicking.</p>
    </div>
  </a>
  <a class="card">
    <div class="card-hero">
      <img src="./images/NJ.jpeg" width="320" />
    </div>
    <div class="card-header">
      <h3>Delaware Water Gap</h3>
    </div>
    <div class="card-body">
      <p>The Delaware Water Gap, straddling the border between New Jersey and Pennsylvania, is a breathtaking natural wonder known for its stunning scenery, recreational opportunities, and ecological significance. This iconic geological formation is a picturesque area where the Delaware River cuts through the Appalachian Mountains, creating a dramatic and scenic river gorge.</p><br>
        <p>The Delaware Water Gap is a 40-mile stretch of the Delaware River that runs along the border between New Jersey and Pennsylvania. The Delaware Water Gap National Recreation Area is a 70,000-acre park that encompasses the Delaware Water Gap and the surrounding area. The park is a popular destination for outdoor recreation, including hiking, biking, fishing, and camping.</p>
    </div>
  </a>
  <a class="card">
    <div class="card-hero">
      <img src="./images/Jcity (1).jpeg" width="320" />
    </div>
    <div class="card-header">
      <h3>Jersey City</h3>
    </div>
    <div class="card-body">
      <p>Jersey City, located along the western bank of the Hudson River and directly across from Lower Manhattan, is a vibrant and rapidly growing urban center in the state of New Jersey. It has evolved into a dynamic and diverse city with a unique blend of historic charm, modern skyscrapers, and cultural richness.</p><br>
        <p>Jersey City is home to a variety of attractions, including Liberty State Park, the Liberty Science Center, and the Jersey City Museum. The city is also home to a thriving arts scene, with a number of galleries, theaters, and performance venues. Jersey City is also home to a variety of restaurants, bars, and nightclubs, making it a popular destination for nightlife.</p>
        <br><br><br>
    </div>
  </a>
  <a class="card">
    <div class="card-hero">
      <img src="./images/trenton.jpeg" width="320" height="200"/>
    </div>
    <div class="card-header">
      <h3>Trenton</h3>
    </div>
    <div class="card-body">
      <p>Trenton, the capital city of New Jersey, is a place rich in history, culture, and civic importance. Situated along the banks of the Delaware River in the central part of the state, Trenton has played a significant role in American history and continues to serve as a hub for government, industry, and the arts.</p><br>
        <p>Trenton is home to a variety of attractions, including the New Jersey State Museum, the Old Barracks Museum, and the Trenton City Museum. The city is also home to a variety of restaurants, bars, and nightclubs, making it a popular destination for nightlife. The State House, dating back to the 18th century, reflects Trenton's central role in shaping New Jersey's governance.</p>
        <br><br><br><br>
    </div>
  </a>
</div>
<section>
   <h1 style="color: #1fc7d6;">Gem of the week:</h1>
</section>
   <br>
   <br>
   <iframe src="https://storage.googleapis.com/maps-solutions-6z18k4jibn/neighborhood-discovery/oi0v/neighborhood-discovery.html"
  width="100%" height="300%"
  style="border:0;"
  loading="lazy">
</iframe>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br><br><br><br><br><br><br>
    <?php include "footer.php"?>
</body>
</html>