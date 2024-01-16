<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>

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
    <?php include "nav.php"?>
    <!-- Contact Section Start -->
    <section class="contact" id="contact">
        <div class="contact-text">
            <h2>Get In <span>Touch</span></h2>
            <p>Please do not hesistate to get in touch with our team through our "Get in touch portal"</p>
            <p>Here you have the liberty to share your feedback with the team as well as any concerns/problems that you as the user may have envountered.</p>
            <p> Your feedback is very important to us as we take your feedback very seriously. we are always looking for ways to improve! </p>
            <div class="list">
                <li><a href="#">(908) 737-5326</a></li>
                <li><a href="#">parraolk@kean.edu</a></li>
                <li><a href="https://www.kean.edu/">Kean University</a></li>
            </div>
        </div>

        <div class="contact-form">
            <form action="https://formspree.io/f/mqkvrgqp" method="POST">
                <input type="text" placeholder="Name" required name="name">
                <input type="number" placeholder="Phone" required name="phone">
                <input type="email" placeholder="Email" required name="email">
                <textarea name="message" id="" cols="35" rows="10" placeholder="Message" required></textarea>
                <input type="submit" value="Submit" class="submit" required>
            </form>
        </div>
    </section>
    <!-- Contact Section End -->
    <?php include "footer.php"?>
</body>
</html>