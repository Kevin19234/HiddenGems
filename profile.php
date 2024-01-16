<html>
<head>
    <link rel="stylesheet" type="text/css" link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
<?php
    include "dbconfig.php";
    $con = mysqli_connect($host,$username, $password, $dbname);

    // get 'logged_in' cookie that was set in `login.php`
    if(isset($_COOKIE["logged_in"])) {
        $token = $_COOKIE["logged_in"];

        // extract email from the cookie (formatted 'email|id|name')
        $email = explode('|', $token)[0];

         // query Database for this user (from email) and get their name, email, favorite hobby and food
        $query = "SELECT * FROM hg_users where email = '$email'";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $hobby = $row['hobby'];
                $fav_food = $row['favorite_food'];

                // access map of hobby => articles and food => articles to show articles
                $hobby_to_article = [
                    'reading' => [
                        'https://www.mycentraljersey.com/story/things-to-do/2022/03/31/nj-library-week-2022-activities-historic-library-architecture/9374933002/',
                        'https://bestthingsnj.com/bookstores/#gsc.tab=0',
                    ],
                    'cooking' => [
                        'https://heirloomkitchen.com/cooking-classes/',
                        'https://njmonthly.com/articles/eat-drink/the-30-best-restaurants-in-new-jersey-of-2023/',
                    ],
                    'music' => [
                        'https://www.funnewjersey.com/en/page/nj-concert-venues',
                        'https://www.timeout.com/music/the-15-best-new-jersey-songs'
                    ],
                    'exercising' => [
                        'https://steelsupplements.com/blogs/steel-blog/10-best-gyms-in-new-jersey',
                        'https://www.familyhoodcentral.com/outdoor-fitness-parks-and-trails-in-central-nj/'
                    ],
                    'traveling' => [
                        'https://visitnj.org/nj/attractions',
                        'https://travel.usnews.com/rankings/best-places-to-visit-in-new-jersey/'
                    ],
                ];
                $food_to_article = [
                    'pizza' => [
                        'https://thedigestonline.com/dining/top-40-pizzas-in-new-jersey/',
                        'https://www.foodandwine.com/travel/new-jersey-pizza-trail'
                    ],
                    'dumplings' => [
                        'https://www.hobokengirl.com/best-dumplings-north-jersey/',
                        'https://www.northjersey.com/story/entertainment/dining/2022/01/11/best-places-dumplings-north-jersey/8247523002/',
                    ],
                    'barbecue' => [
                        'https://www.njfamily.com/the-best-bbq-in-new-jersey/',
                        'https://nj1015.com/best-barbecue-restaurants-new-jersey/'
                    ],
                    'pasta' => [
                        'https://www.theguardian.com/us-news/2023/may/06/new-jersey-pasta-dump-mystery',
                        'https://www.nj.com/food/2023/09/the-25-best-pasta-sauces-available-in-new-jersey-ranked.html'
                    ],
                    'fish' => [
                        'https://943thepoint.com/the-best-fresh-caught-seafood-market-in-new-jersey-was-a-local-secret-until-now/',
                        'https://www.njfishing.com/'
                    ],
                ];

                $hobby_articles = $hobby_to_article[$hobby];
                $food_articles = $food_to_article[$fav_food];
            }
        }
    }
   
   
    
?>
    <div class="container">
        <div class="main">
            <div class="topbar">
                <a href="index.php">Home</a>
                <a href="about_us.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="user_logout.php">Logout</a>
                <div class="icon" onclick="toggleNotifi()">
                    <img src="bell.jpg" alt=""> <span>4</span>
                </div>

            </div>
            <div class="notifi-box" id="box">
                <h2>Notification <span>4</span></h2>
                <div class="notifi-item">
                    <img src="image.jpg" alt="img">
                    <div class="text">
                        <h4>Nick Moffa</h4>
                        <p>Liked your post </p>
                    </div>
                </div>
    
                <div class="notifi-item">
                    <img src="face.png" alt="img">
                    <div class="text">
                        <h4>Tim Brown</h4>
                        <p>Comment on your post </p>
                    </div>
                </div>
    
                <div class="notifi-item">
                    <img src="face2.jpeg" alt="img">
                    <div class="text">
                        <h4>Joe Johnson</h4>
                        <p>Liked your post </p>
                    </div>
                </div>
    
                <div class="notifi-item">
                    <img src="face3.png" alt="img">
                    <div class="text">
                        <h4>Tom Smith</h4>
                        <p>Comment on your post </p>
                    </div>
                </div>
    
            </div>
            <div class="row">
                <div class="col-md-4 mt-1">
                    <div class="card text-center sidebar">
                        <div class="card-body">
                            <img src="image.jpg" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h3><?php echo $fname.' '.$lname; ?></h3>
                                <a href="index.php">Home</a>
                                <a href="about_us.php">About</a>
                                <a href="contact.php">Contact</a>
                                <a href="user_logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-1">
                    <div class="card mb-3 content">
                        <h1 class="m-3 pt-3">About</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>First Name</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php echo $fname; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Last Name</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php echo $lname; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Email</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php echo $email; ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card mb-3 content">
                        <h1 class="m-3">Favorite Things</h1>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Food</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php echo ucfirst($fav_food).'<br>'; ?>
                                    <ul>
                                        <?php $i=1; foreach($food_articles as $article){echo "<li><a href=".$article.">Article $i</a></li>"; $i = $i+1;}?>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h5>Hobbies</h5>
                                </div>
                                <div class="col-md-9 text-secondary">
                                    <?php echo ucfirst($hobby).'<br>'; ?>
                                    <ul>
                                        <?php $i=1; foreach($hobby_articles as $article){ echo "<li><a href=".$article.">Article $i</a></li>"; $i = $i+1; }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>


