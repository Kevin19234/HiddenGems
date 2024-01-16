<html>
<title>Hidden GEM Login</title>
<?php
include "dependencies.php";
session_start();
echo"<head>";
headingdependencies();

echo"</head>";
include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
//$con = mysqli_connect($host,$username, $password, $dbname);
//$con = mysqli_connect($host,$username, $password, $dbname, null, null, [MYSQLI_CLIENT_SSL]);
//$con = new mysqli($host,$username, $password, $dbname);

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



</style>

<?php
#Login will be similiar to signup
#Except our goal is to check if the email exists in the system, passwords matches, and to set a cookie/session variables to "keep users logged in"




#Attempt to establish Connection, else if it fails we close the program
if(!$con){
  die("Connection Failed! Please Try Again Later!");
}
#check if post is set, else  return user to login-register

if(!isset($_POST['loginemail']) or !isset($_POST['loginpassword']) ){
header('location: login-register.php');
die();
}


if(isset($_POST['rmeme'])){
  $rmeme= true;
}
else{
  $rmeme= false;
}



$messages = array();
#=======================Empty Check==========================
#retrieve the all values from the gsol user login HTML post method
#if data is empty we do not want to proceed


#We must validate the login email and password are not empty or do not meet proper formatting (We can ignore login query)
#++++++++++++++++++++++++++++++++++++++++++++++++++
$gEmail=mysqli_real_escape_string($con,$_POST["loginemail"]);
if(empty(trim($gEmail))) {
  array_push($messages,"Email is empty! ");
}
elseif(!filter_var($gEmail, FILTER_VALIDATE_EMAIL)){
  array_push($messages,"Invalid Email Format!");

}
else{
  $gEmail = trim($gEmail, " ");
}

#++++++++++++++++++++++++++++++++++++++++++++++++++++

$gPassword=mysqli_real_escape_string($con,$_POST["loginpassword"]);
if(empty(trim($gPassword)) ) {
  array_push($messages, "Password is Empty! ");
}



#===============================DB Check===============================================
#We want to perform  db checks on most of the data, if we find a fail then we stop the code and exit.
#Establish login chcek query and run.
// $verifyEstablished = false;
// $sqlEmail= "SELECT * FROM vtokens where email ='$gEmail' limit 1";
// $resultEmail = mysqli_query($con, $sqlEmail);
// if($resultEmail) {
//   if(mysqli_num_rows($resultEmail) >0){
//     $rowE = mysqli_fetch_array($resultEmail);
//     $ePassword  = $rowE['ptoken'];
//     #mysqli_free_result($resultEmail);

//     #We must hash the password to perform our match
//     $hepassword = hash("sha256", $gPassword);

//     if($ePassword == $hepassword){
//     array_push($messages, "The email:  ".$gEmail." is not verified!  <form id='verify' name='verify' method = 'post' action = 'verify.php'>
//                <input type='hidden' id='email' name='email' value='$gEmail' />
//           <button type='submit' class='btn btn-primary btn-sm'
//                 style='padding-left: 2.5rem; padding-right: 2.5rem;' id ='verifygo'>Resend Verification Email</button>
//           <h1></h1>
//           </form>    ");}
//     else{
//       array_push($messages, "The email or password is incorrect.");
//     }


//     $verified = false;
//     $verifyEstablished = True; 
//    }
//    else{
//     $verified = true;
//     $verifyEstablished = true;
//    }
// }

// if (!$verifyEstablished){
//   array_push($messages, "Could not establish conntection to verify account status");
// }

#=========================================================================================================
#Last Check, if the array messages contains a count of zero we can assume no previous errors
#We can perform a database check
$varpassed = FALSE; #login success varpassed

if(count($messages)==0 ){

  #We must hash the password to perform our match
  $hpassword = hash("sha256", $gPassword);

  #Establish an intial query and run it.
  $sqlL= "SELECT uid, username, email, pword  FROM hg_users WHERE email='$gEmail'";
  $resultL = mysqli_query($con, $sqlL);

  #--------------------------------------------------------------------------------------------------------------------------------
if($resultL) {
  if(mysqli_num_rows($resultL)>0){
    while($row = mysqli_fetch_array($resultL)){
      $ename = $row["username"];
      $epassword = $row['pword'];
      $eid =$row['uid'];

      #Checks if entered password exists matches with query. If so login the user and set a cookie
      if ($hpassword == $epassword){  
        #Login Success

        #Investigate Better Cookie Procedures
        $specialToken = $gEmail."|".$eid."|".$ename;

      

       // if($verified){
        if($rmeme){
          setcookie("logged_in", $specialToken, time()+60*60*24*30);
        }
        else{
          setcookie("logged_in", $specialToken, time()+60*60);
        }
        $varpassed = True;
     // }
     // else{
     //   $varpassed = false;
     // }

      }
      else{
        #Email found but passwords does not match

        array_push($messages, "The email or password is incorrect.");
        }
      }
  }
  else{
    #the email has not been found in the database

    array_push($messages, "Sorry no such email exists in our system.");
    
    }
}
mysqli_free_result($resultL);


  
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
    <button type='button' data-bs-target='#myGameCarousel' data-bs-slide-to='1' <?php if($varpassed){echo"class='active' aria-current='true' ";} ?> aria-label='Slide 2' hidden></button>
  </div>


<!-- Carousel content -->
  <div class='carousel-inner'>
    <!---------------- Error Display -------------->
    <!-- Card start -->
    <div class='carousel-item <?php if(!$varpassed){echo"active";} ?>' >
      <div class = 'overlay-image' id = "background-image"></div>
      <div class ='container'>
        <div class='card text-bg-dark mb-3 w-75 ' style=''>
            


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >

        <h1>Login Failed!</h1>
        <ul>
          <?php foreach($messages as $value){echo "<li>".$value."</li>";} ?>
        </ul>

        <div class="row">
      <h4>Return to <a href = "login-register.php" class="link-light">Login</a></h4>
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
    <!-- Card end -->






        <!-- Card start -->
    <div class='carousel-item <?php if($varpassed){echo"active";} ?>' >
      <div class = 'overlay-image' id = "background-image"></div>
      <div class ='container'>
        <div class='card text-bg-dark mb-3 w-75 ' style=''>
            


   <div class="container-fluid h-custom d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center " style="width:100%;">
      <div class="col-md-12" >
        <div class = "row">
        <h1>Login Successful!</h1>
        </div>
        <div class = "row">
        <h3>You may now return to the homepage or go to your dashboard.</h3>
        </div>
        <div class = "row">
          <h4><a class = "link-success" href="profile.php">Profile</a></h4>
        </div>
        <div class = "row">
          <h4><a class = "link-success" href="index.php">Homepage</a></h4>
        </div>

  

  



      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 " id = "footer">
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




</div>
<!-- game carousel end-->


</body>

</html>