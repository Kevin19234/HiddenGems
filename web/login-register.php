<html>
<title>Hidden GEM Login or Register</title>
<?php
include "dependencies.php";
#session_start();
echo"<head>";
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



<?php
headingdependencies();
echo"</head>";
#include "dbconfig.php";
#$con = mysqli_connect($host,$username, $password, $dbname);

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


<body>
<?php 
bodydependencies();
?>


<style>

	.carousel-item{
		height:100%;
		background: #ffffff;
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
    background: #FFFFFF;
    color: #000000;
    border-color: #1fc7d6;;
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



<!-- game carousel -->
<div id='myHiddenGemCarousel' class='carousel slide carousel-fade'  >
  <!-- Indicators -->
  <div class='carousel-indicators'>
    <button type='button' data-bs-target='#myHiddenGemCarousel' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1' hidden></button>
    <button type='button' data-bs-target='#myHiddenGemCarousel' data-bs-slide-to='1' aria-label='Slide 2' hidden></button>
    <button type='button' data-bs-target='#myHiddenGemCarousel' data-bs-slide-to='2' aria-label='Slide 3' hidden></button>
  </div>


<!-- Carousel content -->
  <div class='carousel-inner'>
  	<!---------------- Login -------------->
    <!-- Card start -->
    <div class='carousel-item active' >
    	<div class = 'overlay-image' id ="background-image"></div>
    	<div class ='container'>
    		<div class='card text-bg-dark mt-5 pt-6 w-75 ' id='login-box'style='margin-bottom: 13rem !important;'>
    		  	


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >
        <form  id="LoginForm" name="LoginForm" method = "post" action = "login.php">
          <div class="divider d-flex align-items-center my-4">
          	<small><a class = "text-left mx-x mb-0 fw-bold" href="<?php echo"$prev_page";?>" style="">Go Back to <?php echo"$pagename"; ?> </a></small>
            <h2 class="text-center fw-bold mx-3 mb-1 mt-5 " >Login</h2>
          </div>

          <!-- Email input -->

          <div class="form-outline mb-4 " >
            <input type = "email" name="loginemail" id="loginemail" class="form-control form-control-lg"
              placeholder="Email eg. example@email.com" maxlength="50" required>
            <label class="form-label" for="loginemail">Email Address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input name="loginpassword" type="password" id="loginpassword" class="form-control form-control-lg"
              placeholder="Password" minlength="8" maxlength="15" required>
            <label class="form-label" for="loginpassword">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox remember me-->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="rmeme" name = "rmeme">
              <label class="form-check-label" for="rmeme">
                Remember me for 30 days
              </label>
            </div>
            <a href="#!" data-bs-target='#myHiddenGemCarousel' data-bs-slide='3' class=" link-danger">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" id="submit-button">Login</button>
            <p class="h5 fw-bold mt-2 pt-1 mb-1 mt-1">Don't have an account? <a href="" data-bs-target='#myHiddenGemCarousel' data-bs-slide='next'
                class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5" id="footer" >
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0" id="footer-content">
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





			</div>	
  		</div>
    </div>
   	<!-- Card end -->




<!---------------- Register -------------->
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
          <br>

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
            <input type = "email" name="signupEmail" id="signupEmail" class="form-control form-control-lg"
              placeholder="example@email.com" maxlength="50" required>
            <label class="form-label" for="signupEmail">Enter a Valid Email Address</label>
          </div>


           <!-- Username input -->

          <div class="form-outline mb-4 " >
            <input type = "text" name="signupUsername" id="signupUsername" class="form-control form-control-lg"
              placeholder="Username" minlength ="5"maxlength="30" required>
            <label class="form-label" for="signupUsername">Enter a valid Username(Alphanumeric and at least 5 character long )</label>
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
            <button type="submit" class="btn btn-primary btn-lg" id="submit-button">Register</button>
            <p class="h5 fw-bold mt-2 pt-1 mb-1 mt-1">Have an account already? <a href="" data-bs-target='#myHiddenGemCarousel' data-bs-slide='prev'
                class="link-danger">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5" id = "footer">
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


    <!---------------- Forgot Password -------------->
    <!-- Card start -->
    <div class='carousel-item' >
      <div class = 'overlay-image' id ="background-image"></div>
      <div class ='container'>
        <div class='card text-bg-dark mb-3 mt-5 pt-6 w-75 ' id='login-box'style=''>
            


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >
        <form  id="forgotPasswordForm" name="forgotPasswordForm" method = "post" action = "">
          <div class="divider d-flex align-items-center my-4">
            <small><a class = "text-left mx-x mb-0 fw-bold" href="<?php echo"$prev_page";?>" style="">Go Back to <?php echo"$pagename"; ?> </a></small>
            <h2 class="text-center fw-bold mx-3 mb-1 mt-5 " >Forgot Password</h2>
          </div>

          <!-- Email input -->

          <div class="form-outline mb-4 " >
            <input type = "email" name="fpemail" id="fpemail" class="form-control form-control-lg"
              placeholder="Email eg. example@email.com" maxlength="50" required>
            <label class="form-label" for="fpemail">Email Address</label>
          </div>

        

          <div class="d-flex justify-content-between align-items-center">

          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" id="submit-button">Request Password Change</button>

            <p class="h5 fw-bold mt-2 pt-1 mb-1 mt-1">Return to login? <a href="" data-bs-target='#myHiddenGemCarousel' data-bs-slide='next'
                class="link-danger">login</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5" id="footer" >
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0" id="footer-content">
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





      </div>  
      </div>
    </div>
    <!-- Card end -->





    
  </div>




</div>


</body>

</html>