<html>
<title>HiddenGEM Register</title>
<?php
include "dependencies.php";
session_start();
echo"<head>";
headingdependencies();

echo"</head>";
include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
//$con = mysqli_connect($host,$username, $password, $dbname, null, null, [MYSQLI_CLIENT_SSL]);


if(isset($_SESSION['current_page'])){
$prev_page = $_SESSION['current_page'];
	if($_SESSION['current_page'] == 'index.php'){
		$pagename = "Homepage";
	}
	else{
		$pagename= ucwords(str_replace("-", " ",strstr($prev_page, '.', true)));
	}

}
else{
$prev_page = "index.php";
$pagename = "Homepage";
}

?>

<!-- JQuery/JS/Ajax Script -->
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
    <script type="text/javascript"> 
        $(document).ready(function(){
          // Prepare the preview for profile picture
              $("#SignupForm").submit(function(e){

                const birthdate = new Date(document.getElementById("birthdate").value);
                const today = new Date();
                const age = today.getFullYear() - birthdate.getFullYear();
                const ageThreshold = 18;

          if (age < ageThreshold) {
            e.preventDefault(); // Prevent the form from submitting
            document.getElementById("ageMessage").innerHTML = "Cannot Submit Form: Must be atleast 18 years old.";
          }
           
           });
          });

       

        //
        $(document).ready(function(){
          // Prepare the preview for profile picture
              $("#birthdate").change(function(){
                   // Get the selected birthdate from the input field
          const birthdate = new Date(this.value);
          
          // Calculate the age
          const today = new Date();
          const age = today.getFullYear() - birthdate.getFullYear();
          
          // Check if the age is below a certain threshold (e.g., 18 years)
          const ageThreshold = 18;
          
          if (age < ageThreshold) {
            // Display the message if the age is too young
            document.getElementById("ageMessage").innerHTML = "Must be atleast 18 years old.";
          } else {
            // Clear the message if the age is acceptable
            document.getElementById("ageMessage").innerHTML = "";
          }
           });
          });

       
        //Document-ready function event handlers
        
        function ContributorSignupDisplay(){
        if($('#signupContributor').is(":checked")){
          $("#cfields").css("display", "block");
          /*$('#signupContributor').val("True");*/
          document.getElementById("register-title").innerHTML ="Register as Contributor" ;
          //Contributor items on
          $("#organizationName").attr('required', '');    
          $("#contributeType").attr('required', '');    
          
          

        }
        else{
          $("#cfields").css("display","none");
          /*$('#signupContributor').val("False");*/
          document.getElementById("register-title").innerHTML ="Register as Traveler" ;
          //turn contributor items off
          $("#organizationName").removeAttr('required'); 
          $("#contributeType").removeAttr('required'); 
        }
      }

       $(document).ready(function(){
          // Prepare the preview for profile picture
              $("#wizard-picture").change(function(){
                  readURL(this);
              });
          });
          function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                  }
                  reader.readAsDataURL(input.files[0]);
              }
          }  


    </script>
<!-- End of Script -->


<body>
<?php 
bodydependencies();



?>


<style>

  .carousel-item{
    height:100%;
    background: #000;
    color:white;
    background-position: center;
    background-size: cover;
  }

  .container {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    max-height: 60em;
    padding-bottom: 50px;
  }

  .overlay-image{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    top:0;
    background-position: center;
    background-size: cover;
    opacity:  0.5;
  }

  .card{
    left:10%;
    
    height: 100%;
    
  }

  .footer{
    background: #9381FF;
    color:white;
    background-position: center;
    background-size: cover;
  }

  .form-group{
    background-color: #111;
    color:white;
    background-position: center;
    background-size: cover;
    margin-bottom: 0;
  }
  .categories{
    background: #111;
    color:white;
    background-position: center;
    background-size: cover;
  }
  .scrollable{
    margin-top: 10em;
    margin-bottom: 10em;

    overflow-y: auto;
    max-height:50em;
  }


  #footer{
    background-color: #1fc7d6;
  }



  #background-image{
    background-color:#333333;
  }
  #submit-button{
    padding-left: 2.5rem; 
    padding-right: 2.5rem; 
    background: #A882DD;
  }


  input[type="text"], textarea {

  background-color :#F8F7FF;
  }

  #cfields{
    display: none;
  }





  /*Profile Pic Start*/
.picture-container{
    position: relative;
    cursor: pointer;
    text-align: center;
}
.picture{
    width: 10em;
    
    background-color: #999999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
}
.picture:hover{
    border-color: #2ca8ff;
}
.content.ct-wizard-green .picture:hover{
    border-color: #05ae0e;
}
.content.ct-wizard-blue .picture:hover{
    border-color: #3472f7;
}
.content.ct-wizard-orange .picture:hover{
    border-color: #ff9500;
}
.content.ct-wizard-red .picture:hover{
    border-color: #ff3b30;
}
.picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
}

.picture-src{
    width: 100%;
    
}
/*Profile Pic End*/


</style>

<?php
#Attempt to establish Connection, else if it fails we close the program
if(!$con){
  die("Connection Failed! Please Try Again Later!");
}
#check if post is set, else set 

if(!isset($_POST['signupUsername']) or !isset($_POST['signupEmail']) or !isset($_POST['signupPassword']) or !isset($_POST['signupPassword2'])){
header('location: login-register.php');
die();
}



$messages = array();
#=======================Empty Check==========================
#retrieve the all values from the gsol user signup HTML post method
#if data is empty we do not want to proceed
$gUsername=mysqli_real_escape_string($con,$_POST["signupUsername"]);
if(empty(trim($gUsername))) {
  array_push($messages,"Username is not valid! Empty!");
}
elseif( !preg_match( '/^[a-zA-Z0-9]{5,}$/' ,$gUsername)) //alphanumeric, longer than 5 characters
{
  array_push($messages, "Username must be alphanumeric and/or at least 5 characters long.");
}
else{
$gUsername = trim($gUsername, " "); 
}

#++++++++++++++++++++++++++++++++++++++++++++++++++
$gEmail=mysqli_real_escape_string($con,$_POST["signupEmail"]);
if(empty(trim($gEmail))) {
  array_push($messages,"Email is empty! ");
}
elseif(!filter_var($gEmail, FILTER_VALIDATE_EMAIL)){
  array_push($messages,"Email Format is not Valid!");

}
else{
  $gEmail = trim($gEmail, " ");
}
//++++++++++Full name+++++++++++++++++++++++++++++++++++++++++++
$fname=mysqli_real_escape_string($con,$_POST["fname"]);
if(empty(trim($fname))) {
  array_push($messages,"First Name is not valid! Empty!");
}
else{
  $fname = trim($fname, " ");
}
$lname=mysqli_real_escape_string($con,$_POST["lname"]);
if(empty(trim($lname))) {
  array_push($messages,"Last Name is not valid! Empty!");
}
else{
  $lname = trim($lname, " ");
}
#+++++DOB+++++++++++++++++++++++++++++++++++++++++++
$dob=mysqli_real_escape_string($con,$_POST["birthdate"]);


#++++++++++++++++++++++++++++++++++++++++++++++++++++

$gPassword=mysqli_real_escape_string($con, $_POST["signupPassword"]);
$gPassword2=mysqli_real_escape_string($con, $_POST["signupPassword2"]);
if(empty(trim($gPassword)) or empty(trim($gPassword2))) {
  array_push($messages, "Password is not valid! EMPTY Pasword detected! ");
}
elseif($gPassword != $gPassword2){
  array_push($messages, "Passwords do not Match!");
}
elseif( strlen(trim($gPassword, " "))> 7 && strlen(trim($gPassword, " "))<16 && preg_match('/[a-z]/', $gPassword) && preg_match('/[A-Z]/',$gPassword)){
  $mPass =1;
  $pCT = 0;

  if( preg_match('/[0-9]/', $gPassword) ) { $pCT++; }  // contains digit
  if( preg_match('/[A-Z]/', $gPassword) ) { $pCT++; }  // contains upercase
  if( $pCT > $mPass ) {
        // valid password
      $gPassword = trim($gPassword, " ");
      $gPassword2 = trim($gPassword2, " ");
    }
  else{
      array_push($messages, "Password is missing 1 number and/or 1 uppercase letter");
  }
}
else{
  array_push($messages, "Password must include atleast 1 Uppercase letter, 1 Number, and be 8-15 characters long.");
}




#===============================POST Variables DB Check===============================================
#We want to perform  db checks on most of the data, if we find a fail then we stop the code and exit.
#Establish login chcek query and run.
$sqlEmail= "SELECT email FROM hg_users WHERE email='$gEmail'";
$sqlUsername= "SELECT username FROM hg_users WHERE username='$gUsername' ";
$resultEmail = mysqli_query($con, $sqlEmail);
$resultUsername = mysqli_query($con, $sqlUsername);
if($resultEmail) {
  if(mysqli_num_rows($resultEmail) ==1){
    mysqli_free_result($resultEmail);
    array_push($messages, "The email:  ".$gEmail." is already taken!!");
   }
}
if($resultUsername) {
  if(mysqli_num_rows($resultUsername) ==1){
    mysqli_free_result($resultUsername);
    array_push($messages, "The Username:  ".$gUsername." is already taken!!");
   }
}
if(isset($_POST["hobby"])){
  $hobby = strtolower(mysqli_real_escape_string($con,$_POST['hobby']));
}
else{
  $hobby = "traveling";
}
if(isset($_POST["food"])){
  $food = strtolower(mysqli_real_escape_string($con,$_POST['food']));
}
else{
  $food ="pizza";
}
#==============================Contributor Items====================================================================
if(isset($_POST["signupContributor"])){
  $roleVal = mysqli_real_escape_string($con,$_POST['contributeType']);
  $brandname = mysqli_real_escape_string($con,$_POST['organizationName']);
  if($roleVal == 1){
    $role = "individual";
    $brand = True;
  }
  elseif($roleVal == 2){
    $role ="business";
    $brand = True;
  }
  else{
    $role ="traveler";
    $brand = False;
  }
}
else{
  $role ="traveler";
  $brandname = null;
  $brand = False;
}
//Check image- add more checking later
if(isset($_FILES['wizard-picture']['name'])){
  $profilepicture = file_get_contents($_FILES['wizard-picture']['tmp_name']);
}
else{
  $profilepicture = null;
}
#=========================================================================================================
#Last Check, if the array messages contains a count of zero we can assume no errors
$varpassed = FALSE;

if(count($messages)==0 ){
  #On successful registration we must first hash our passwords

  // Generate a unique verification token
  $token = hash('sha256', uniqid()."$gEmail");
  // Simple hash of password; Here is where you will most likely call in some other function/file to do more advanced hashing
  $gPassword = hash('sha256', $gPassword);


  $varpassed = TRUE;
  #echo"<H1>Success</H1>";
 if($brand){
  $sql2="INSERT INTO hg_users(fname, lname, email, dob, pword, role, username,profile_picture,verification_token, brandname, hobby, favorite_food, is_verified)values('$fname', '$lname', '$gEmail', '$dob', '$gPassword', '$role', '$gUsername', '$profilepicture', '$token', '$brandname', '$hobby','$food', 1)";
  }
  else{
    $sql2="INSERT INTO hg_users(fname, lname, email, dob, pword, role, username,profile_picture,verification_token, hobby, favorite_food, is_verified)values('$fname', '$lname', '$gEmail', '$dob', '$gPassword', '$role', '$gUsername', '$profilepicture', '$token', '$hobby','$food', 1)";
  }
  $result2 = mysqli_query($con, $sql2);

  if($result2){
    // Do Nothing
     #$verify_link = "https://localhost/GameSolaris/verify.php?token=".$token."";
    //$command = "python3.9 ../cgi-bin/Secure/email-verify.py ".$gEmail." ".$token."";
    #$command = "python Secure/email-verify.py ".$gEmail." ".$token."";
    //$pyresult = shell_exec($command);
  }
  else{
        #If the query failed kill the process
    die("Something went Wrong! Return to <a href='index.php'>Homepage</a>");
  //echo"New Customer: ".$clogin." Added <br>";
  //   echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>";#return to Project 2 Phase1
  // 

  }
}
else{
#On fail do nothing, allow messages arrive to error report screen/card
#echo"<h1> Fail</h1>";

}






?>


<!-- game carousel -->
<div id='myGameCarousel' class='carousel slide carousel-fade'  >
  <!-- Indicators -->
  <div class='carousel-indicators'>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='0' <?php if(!$varpassed){echo"class='active' aria-current='true' ";} ?>  aria-label='Slide 1' hidden></button>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='1' aria-label='Slide 2' hidden></button>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='2' <?php if($varpassed){echo"class='active' aria-current='true' ";} ?> aria-label='Slide 3' hidden></button>
  </div>


<!-- Carousel content -->
  <div class='carousel-inner'>
  	<!---------------- Error Display -------------->
    <!-- Card start -->
    <div class='carousel-item <?php if(!$varpassed){echo"active";} ?>' >
    	<div class = 'overlay-image' id = "background-image" ></div>
    	<div class ='container'>
    		<div class='card text-bg-dark mb-3 w-75 ' style=''>
    		  	


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >

        <h1>Registration Failed!</h1>
        <ul>
          <?php foreach($messages as $value){echo "<li>".$value."</li>";} ?>
        </ul>

        <p><a data-bs-target='#myGameCarousel' data-bs-slide='next'
                class="link-danger">Try Again</a></p>
        




      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Game Solaris Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





			</div>	
  		</div>
    </div>
   	<!-- Card end -->




<!---------------- Sign Up -------------->
    <!-- Card start-->
   <div class='carousel-item' >
      <div class = 'overlay-image' id = "background-image" ></div>
      <div class ='container' style='overflow:scroll;'>
        <div class='card text-bg-dark w-75' id='register-box' style='margin-bottom: 13rem !important;'>





   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >





        <form id="SignupForm" name="SignupForm" method = "post" action = "register.php">
          <div class="divider d-flex align-items-center my-4">
          	<small><a class = "text-left mx-x mb-0 fw-bold " href="<?php echo"$prev_page";?>" style="">Go Back to <?php echo"$pagename"; ?> </a></small>
            <h2 class="text-center fw-bold mx-3 mb-1 mt-5" name ="register-title" id="register-title" >Register as Traveler</h2>
          </div>

          <div id ="error"></div>

          <div class="form-outline">
              <div class="picture-container">
                  <div class="picture">
                      <img src="ProfileDefault.png" class="picture-src" id="wizardPicturePreview" >
                      <input type="file" id="wizard-picture" name="wizard-picture" class="" accept="image/png, image/jpeg">
                  </div>

                   <h6 class="">Upload profile picture</h6>

              </div>
          </div>

          <!-- Email input -->

          <div class="form-outline mb-4 " >
            <input  type = "email" name="signupEmail" id="signupEmail" value = "<?php echo($gEmail); ?>" class="form-control form-control-lg"
              placeholder="example@email.com" maxlength="50" required>
            <label class="form-label" for="signupEmail">Enter a Valid Email Address</label>
          </div>


           <!-- Username input -->

          <div class="form-outline mb-4 " >
            <input type = "text" name="signupUsername" id="signupUsername" value = "<?php echo($gUsername); ?>" class="form-control form-control-lg"
              placeholder="Username" maxlength="30" required>
            <label class="form-label" for="signupUsername">Enter a valid Username(No offensive words)</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input name="signupPassword" type="password" id="signupPassword" class="form-control form-control-lg"
              placeholder="Enter password" minlength="8" maxlength="15" required>
            <label class="form-label" for="signupPassword">Enter a valid Password(8-15 charcters, alphanumeric, Case Senstive, Include atleast 1 number and 1 uppercase letter.)</label>
          </div>
          <!-- Password input -->
          <div class="form-outline mb-3">
            <input name="signupPassword2" type="password" id="signupPassword2" class="form-control form-control-lg"
              placeholder="Retype password" minlength='8' maxlength="15" required>
            <label class="form-label" for="signupPassword2">Retype Password</label>
          </div>

          <!--Name input -->
          <div class="form-outline mb-3 row">
            <div class ="col">
            <input type="text" aria-label="First name" name ="fname" id ="fname" class="form-control" placeholder="First Name" maxlength="55" required>
            <label class="form-label" for="fname">First Name</label>
          </div>
          <div class ="col">
            <input type="text" aria-label="Last name" name="lname" id ="lname" class="form-control" placeholder="Last Name" maxlength="55" required>
            <label class="form-label" for="lname">Last Name</label>
          </div>
        </div>

          <!-- Birthdate-->
           <div class="form-outline mb-3">
          <p id="ageMessage" style="color: red;"></p>
          <input type="date" id="birthdate" name="birthdate" min="1920-01-01" max="2024-12-31">
          <label for="event-date">Date of birth:</label>
           </div>

           <br>
           <br>
           <div class="form-outline mb-3 row">
            <div class ="col">
            <select aria-label="Question1" name ="hobby" id ="hobby" class="form-control" placeholder="Favorite Hobby" maxlength="55" required>
                <option value="reading">Reading</option>
                <option value="cooking">Cooking</option>
                <option value="music">Music</option>
                <option value="exercising">Exercising</option>
                <option value="traveling">Traveling</option>
            </select>
            <label class="form-label" for="fname">What's your favorite hobby?</label>
          </div>
          <div class="col">
            <select aria-label="Question2" name="food" id ="food" class="form-control" placeholder="Favorite Food" maxlength="55" required>
                <option value="pizza">Pizza</option>
                <option value="dumplings">Dumplings</option>
                <option value="barbecue">Barbecue</option>
                <option value="pasta">Pasta</option>
                <option value="fish">Fish</option>
            </select>
            <label class="form-label" for="lname">What's your favorite food?</label>
          </div>
          </div>






          <!-- Contributor Signup -->
            <!-- Checkbox Contributor-->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="signupContributor" name = "signupContributor" onchange="ContributorSignupDisplay()">
              <label class="form-check-label" for="signupContributor">
                Contributor Account
              </label>
            </div>
           <!-- Contributors Variables -->


          <div class="form-outline mb-4 " name ="cfields" id = "cfields" >
            <br>
            <input type = "text" name="organizationName" id="organizationName" class="form-control form-control-lg"
              placeholder="Organization/Brand Name" minlength ="5"maxlength="50">
            <label class="form-label" for="organizationName">Enter a valid Organization or Brand Name(Alphanumeric and at least 5 character long)</label>

            <select class="form-select" name="contributeType" id="contributeType" aria-label="select-type">
              <option value ="" disabled selected>Select Contributor Type</option>
              <option value="1">Individual</option>
              <option value="2">Business</option>
            </select>

          </div>

          <!-- Contributor items end-->
          <br>




          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox Agree to terms-->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="signupTerms" name = "signupTerms" required>
              <label class="form-check-label" for="signupTerms">
                Agree to our <a href="terms-of-use.php" target="_blank">Terms of Use</a>.
              </label>
            </div>
            
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Signup</button>
            <p class="h5 fw-bold mt-2 pt-1 mb-1 mt-1">Have an account already? <a href="login-register.php"
                class="link-danger">Login</a></p>
          </div>
        </form>




      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
     <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0" id="footer-content" >
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>






			</div>
  		</div>
    </div>
    <!-- Card end -->

        <!-- Card start -->
    <div class='carousel-item <?php if($varpassed){echo"active";} ?>' >
      <div class = 'overlay-image' id = "background-image" ></div>
      <div class ='container'>
        <div class='card text-bg-dark mb-3 w-75 ' style=''>
          <small><a class = "text-left mx-x mb-0 fw-bold " href="<?php echo"$prev_page";?>" style="">Go Back to <?php echo"$pagename"; ?> </a></small>
            


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >
        <div class = "row">
        <h1>Registration Successful!</h1>
        </div>
        <div class = "row">
          <h3>You have successfully registered! Return to login page!</h3>
        <!--<h3>A verification email has been sent to your email with the verification link.</h3>-->
        </div>
        <div class = "row">
         <h5>Return to <a href="login-register.php" class="link-primary">Login</a></h5>
        <!--<h5>Didn't receive a link?</h5>-->
        </div>
       <!-- <div class = "row bp-5">

          <div class ="col-4 bp-5">
            <form id="verify" name="verify" method = "post" action = "verify.php">
               <input type="hidden" id="email" name="email" value="<?php echo($gEmail);?>" />
          <button type="submit" class="btn btn-primary btn-sm"
                style="padding-left: 2.5rem; padding-right: 2.5rem;" id ="verifygo">Send Again</button>
          <h1></h1>
          </form>
          </div>

        </div> -->

        




      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Game Solaris Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





      </div>  
      </div>
    </div>
    <!-- Card end -->





    
  </div>




</div>
<!-- game carousel end-->




<!--

	  <- Buttons ->
  <button class='carousel-control-prev' type='button' data-bs-target='#myGameCarousel' data-bs-slide='prev' aria-hidden='true'>
    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Previous</span>
  </button>
  <button class='carousel-control-next' type='button' data-bs-target='#myGameCarousel' data-bs-slide='next' aria-hidden='true'>
    <span class='carousel-control-next-icon' aria-hidden='true'></span>
    <span class='visually-hidden'>Next</span>
  </button>

-->

</body>

</html>