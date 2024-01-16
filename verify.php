<html>
<title>HiddenGEM Verification</title>
<?php
include "dependencies.php";
session_start();
echo"<head>";
headingdependencies();

echo"</head>";
include "dbconfig.php";
//$con = new mysqli($host,$username, $password, $dbname);
$con = mysqli_connect($host,$username, $password, $dbname);

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

#Verify- Login account unverified
#Verify- Resend
#Verify- token expired
#VErify- token invalid 
#Verify-Success



#messages
$messages = array();

$resettoken= false; #email is
$truetoken=false;
$truetokenexpired = false; 

#Type 0 equals, page access not valid display error messages-->login/signup| Type 1 will be for resend Verification -->resend| Type 2 will be Token Expired --> Resend| Type 3 Verify Success -->login/signup
$operationType = 0; 


#check if it is a reset/resend, then check if it token verify(IF so then check if expired), otherwise we might assume the page was accessed incorrectly

if(isset($_POST["email"])){
  $gEmail = $_POST['email'];
  $sqlEmail= "SELECT * FROM vtokens where email ='$gEmail' limit 1";
  $resultEmail = mysqli_query($con, $sqlEmail);
  if($resultEmail) {
    if(mysqli_num_rows($resultEmail) == 0){
      mysqli_free_result($resultEmail);
      array_push($messages,"Somewthing Went wrong with resend request! The account your accessing may not exists or is already verified!");
       $operationType = 0; 
 
     }
     else{
        $resettoken = TRUE;
          $gEmail = mysqli_real_escape_string($con,$_POST["email"]);

          // Generate a unique verification token
          $token = hash('sha256', uniqid()."$gEmail");
          $sqlTI = "UPDATE vtokens SET gtoken ='$token', exp_date = (NOW()+INTERVAL 10 MINUTE)   where email ='$gEmail' " ;
          $resultTI = mysqli_query($con, $sqlTI);
          if($resultTI){
            #$verify_link = "https://localhost/GameSolaris/verify.php?token=".$token."";
            $command = "python3.9 ../cgi-bin/Secure/email-verify.py ".$gEmail." ".$token."";
           #$command = "python Secure/email-verify.py ".$gEmail." ".$token."";
            $pyresult = shell_exec($command);
            $operationType = 1;


             }
          }
        }
  
  else{
        #If the query failed kill the process
    array_push($messages,"Somewthing Went wrong with resend request! Try again later.");
    $operationType = 0; 
  }

}
#If it is not a resend then we will check if a token exists, if so then we perform some operations.
elseif(isset($_GET['token'])){
 
 $token = mysqli_real_escape_string($con, $_GET['token']); 
 $tokenQuery ="SELECT email, gtoken, exp_date, verification_status,now() as cur_time from vtokens where gtoken ='$token' LIMIT 1" ;
 $resultTQ = mysqli_query($con, $tokenQuery);


   if($resultTQ AND mysqli_num_rows($resultTQ) == 1){
    $rowTQ = mysqli_fetch_array($resultTQ);
    $gEmail = $rowTQ['email'];
    $gtoken = $rowTQ["gtoken"];
    $exp_date= $rowTQ["exp_date"];
    $verification_status=$rowTQ["verification_status"];
    $cur_time = $rowTQ["cur_time"];

    if($cur_time< $exp_date ){

    $validationQuery= "UPDATE vtokens SET verification_status = TRUE  where gtoken ='$gtoken' ";
      if(mysqli_query($con, $validationQuery)){
        #Success
        $operationType = 3;
      }
      else{
        #Fail, something went wrong
        array_push($messages,"Something went wrong with the validation process!");
        $operationType = 0;
      }

    }
    else{
      #Token has expired, can not update must request a verfication link to be resent
      $operationType = 2;
      # $gEmail is retrieved previously from the database

    }



   }
   else{
    #Token not found, Token is invalid
    $truetoken = false;
    $operationType = 0;
    array_push($messages,"No such token has been found!");

   }

}
else{
# No Email in POST and NO Token in GET
  array_push($messages, "Invalid Verify Page Access! Please Return to Signup/Login. ");
  $operationType = 0;


}




?>


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
    bottom: 0;
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
    background: #1fc7d6;
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

  #background-image{
    background-color:#333333;
  }
  #submit-button{
    padding-left: 2.5rem; 
    padding-right: 2.5rem; 
    background: #999999;
  }
  #verifygo{
    padding-left: 2.5rem; 
    padding-right: 2.5rem; 
    background: #999999;
  }
  #footer{
    background-color: #1fc7d6;
  }


  input[type="text"], textarea {

  background-color :#F8F7FF;
  }



</style>

<?php
#Operations
#Type 0 equals, page access not valid display error messages-->login/signup| 
#Type 1 will be for resend Verification -->resend| 
#Type 2 will be Token Expired --> Resend| 
#Type 3 Verify Success -->login/signup
?>


<!-- game carousel -->
<div id='myGameCarousel' class='carousel slide carousel-fade'  >
  <!-- Indicators -->
  <div class='carousel-indicators'>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='0' <?php if($operationType == 0){echo"class='active' aria-current='true' ";} ?>  aria-label='Slide 1' hidden></button>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='1' <?php if($operationType == 1){echo"class='active' aria-current='true' ";} ?>  aria-label='Slide 2' hidden></button>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='2' <?php if($operationType == 2){echo"class='active' aria-current='true' ";} ?> aria-label='Slide 3' hidden></button>
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='3' <?php if($operationType == 3){echo"class='active' aria-current='true' ";} ?> aria-label='Slide 4' hidden></button>
  </div>


<!-- Carousel content -->
  <div class='carousel-inner'>
  	<!---------------- Error Display Operation Type 0 -------------->
    <!-- Card start -->
    <div class='carousel-item <?php if($operationType == 0){echo"active";} ?>' >
    	<div class = 'overlay-image' id = "background-image"></div>
    	<div class ='container'>
    		<div class='card text-bg-dark mb-3 w-75 ' style=''>
    		  	


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >

        <h1>Verification Error!</h1>
        <ul>
          <?php foreach($messages as $value){echo "<li>".$value."</li>";} ?>
        </ul>

        <p><a href ="login-register.php"
                class="link-danger">Return to Login/Signup</a></p>
        




      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5" id = "footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





			</div>	
  		</div>
    </div>
   	<!-- Card end -->




<!---------------- Resend Verification Operation Type 1 -------------->
    <!-- Card start-->
    <div class='carousel-item <?php if($operationType == 1){echo"active";} ?>' >
    	<div class = 'overlay-image' id = "background-image"></div>
    	<div class ='container'>
    		<div class='card text-bg-dark mb-3 w-75' style=''>
   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >


 <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >
        <div class = "row">
        <h1>Registration Email Resent!</h1>
        </div>
        <div class = "row">
        <h3>A verification email has been sent to your email with the verification link.</h3>
        </div>
        <div class = "row">
        <h5>Didn't receive a link?</h5>
        </div>
        <div class = "row bp-5">

          <div class ="col-4 bp-5">
            <form id="verify" name="verify" method = "post" action = "verify.php?token=<?php if(isset($token)){echo($token);} ?>">
              <input type="hidden" id="email" name="email" value="<?php echo($gEmail);?>" />
          <button type="submit" class="btn btn-primary btn-sm"
                style="padding-left: 2.5rem; padding-right: 2.5rem;" id ="verifygo">Send Again</button>
          <h1></h1>
          </form>

           <p><a href ="login-register.php"
                class="link-danger">Return to Login/Signup</a></p>
          </div>

        </div>



       




      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>






			</div>
  		</div>
    </div>

  </div>
</div>
</div>
</div>
    <!-- Card end -->


    <!---------------- Expired Token Operation Type 2 -------------->
        <!-- Card start -->
    <div class='carousel-item <?php if($operationType == 2){echo"active";} ?>' >
      <div class = 'overlay-image' id = "background-image"></div>
      <div class ='container'>
        <div class='card text-bg-dark mb-3 w-75 ' style=''>
            

<div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >
        <div class = "row">
        <h1>Your Token Has expired!</h1>
        </div>
        <div class = "row">
        <h3>Please click the button below to resend verification link </h3>
        </div>
        <div class = "row bp-5">

          <div class ="col-4 bp-5">
            <form id="verify" name="verify" method = "post" action = "verify.php?token=<?php if(isset($token)){echo($token);} ?>">
              <input type="hidden" id="email" name="email" value="<?php echo($gEmail);?>" />
          <button type="submit" class="btn btn-primary btn-sm"
                style="padding-left: 2.5rem; padding-right: 2.5rem;" id ="verifygo">Resend Verification</button>
          <h1></h1>
          </form>
          </div>

        </div>
  
        




      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





      </div>  
      </div>
    </div>

      </div>
</div>
</div>
</div>
    <!-- Card end -->

        <!---------------- Verification Success Operation Type 3 -------------->
    <!-- Card start -->
    <div class='carousel-item <?php if($operationType == 3){echo"active";} ?>' >
      <div class = 'overlay-image' id = "background-image"></div>
      <div class ='container'>
        <div class='card text-bg-dark mb-3 w-75 ' style=''>
            


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >

        <h1>Verification Success!</h1>
        <h3>You can now login!</h3>
        <p><a href ="login-register.php" class="link-danger">Go to Login/Signup</a></p>
        


      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Hidden GEM Copyright © 2023. All rights reserved.
    </div>
    <!-- Copyright -->
  </div>





      </div>  
      </div>
    </div>
    <!-- Card end -->







    
  </div>
  <!-- Carousel Inner End -->



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