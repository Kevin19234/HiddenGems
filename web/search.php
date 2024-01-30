<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="./CSS/styles.css">
<?php
include "dbconfig.php";
include "nav.php";

$con = mysqli_connect($host, $username, $password, $dbname)
        or die('Error connecting to MySQL server.');

$keyword = $_GET['search_items'];
$sql = "SELECT id, title, labels, category, Description,start, predicted_end, venue_name, venue_formatted_address, phq_attendance  from Events WHERE title like '%$keyword%' OR venue_formatted_address like '%$keyword%' OR labels like '%$keyword%' OR category like '%$keyword%'";
$result = mysqli_query($con, $sql);

if($result){
    if(mysqli_num_rows($result)>0){
        echo "<h1>Search Results:</h1><br>";
        echo "<table class='styled-table' border='1'>\n";
        while($row = mysqli_fetch_array($result)){
            $event_name = $row['title'];
            $address = $row['venue_formatted_address'];
            $label = $row['labels'];
            $category = $row['category'];
            $description = $row['Description'];
            $stime = $row['start'];
            $etime = $row['predicted_end'];
            echo "<tr class ='active-row'><td><h3>$event_name</h3><br><br><br>Description: <br> $description <br><br><br>Address:<br> $address<br><br>Category: $category
            <br><br> Start Date & Time: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End Date & Time:<br>$stime
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $etime</tr>";
        }
        echo "</table>\n";
    }
    else {
        echo "No results found";
    }
}

mysqli_free_result($result);
mysqli_close($con);
?>
</body>
</html>