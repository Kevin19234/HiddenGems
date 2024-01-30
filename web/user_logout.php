<?php
include "nav.php"; 

if(!isset($_COOKIE['logged_in'])){
	echo "You successfully logout<br>";
	echo "<br>You will be redirected to HiddenGem's home page in 3 seconds...";
	header("refresh:3;url=index.php");
	die;
}elseif(isset($_COOKIE['logged_in'])){
	echo "You successfully logged out<br>";
	echo "<br>You will be redirected HiddenGem's home page in 3 seconds...";
	header("refresh:3;url=index.php");
	unset($_COOKIE['logged_in']);
	setcookie("logged_in","",time()-3600);
	die;
}
?> 