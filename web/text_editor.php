

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

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
    
    <!--  summernote links -->
    <!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- include libries(jQuery, bootstrap) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="dist/summernote.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$('#summernote').summernote({
		  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ],
        height: "300px",
		styleWithSpan: false
	});
});
function postForm() {

	$('textarea[name="content"]').html($('#summernote').code());
}
</script>


</head>


</html>

<?php
include "nav.php"; 
include "dbconfig.php";

if(isset($_COOKIE['staff_name'])){
    $name = $_COOKIE['staff_name'];
    $Srole = $_COOKIE['staff_role'];
    $login_id = $_COOKIE['staff_id'];

    if ($Srole ='A'){
        $role = 'Admin';


    }else{
        $role ='Manager';}

    echo"
    <body>

        <div class='login'>
            <div class='login-screen'>
            <div class='app-title'>
            <h2>Content Editor</h2>
        </div>


            </div>
        </div>
    </body>
    
    ";

    $con = mysqli_connect($host,$username,$password,$dbname)
    or die("<br> Cannot connect to DB:$dbname on $host");

$sql = "SELECT * FROM hg_users";

$result = mysqli_query($con,$sql);

//		$row = mysqli_fetch_array($result);
//		$login_id = $row['username'];
    echo "<br> Welcome $role : $name </b>
          <br><a href='staff_logout.php'>$role logout</a>
          <a href='manage_users.php'>Manage Users</a>
          <a href='staff_dashboard.php'>$role Dashboard</a>
          <br> ";

echo "		<form id='postForm' action='save-content.php' method='POST' enctype='multipart/form-data' onsubmit='return postForm()'>
			
			<b>Title</b>
			<input type='text' class='form-control' name='title'>
			<br/>
            <b>Keyword</b>
			<input type='text' class='form-control' name='keyword'>
			<br/>
			<textarea id='summernote' name='content' rows='10'></textarea>
			
			<br/>
			<button type='submit' class='btn btn-primary'>Save</button>
			<button type='button' id='cancel' class='btn'>Cancel</button>
		    
		</form>";





}else{
	echo "You must be logged in to add content. <br>";

	die;
}
mysqli_close($con);

?> 