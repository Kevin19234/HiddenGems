<?php session_start();
include_once('dbconfig.php');

$con = mysqli_connect("$server","$username","$password","$dbname");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
echo "DB sucessfully connected...";


$name=mysqli_real_escape_string($con, $_POST['username']);

$pass=mysqli_real_escape_string($con, $_POST['password']);


$sql= "SELECT * FROM Staff WHERE login='$name' and password='$pass' ";

$result = mysqli_query($con,$sql);
$total=mysqli_num_rows($result);
if($total<1){
echo 'That user is not in our system.';
}else{
while ($row = $result->fetch_assoc()) {
echo 'Yes we have a match! Welcome '.$row['login'];
$_SESSION["username"] = $name;
$_SESSION["password"] = $pass;
}
}else{
    echo 'Enter correct password and/or login.'
}
}
$con->close();
?>
