<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$output ='';
//collect
if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	
	$sql = "SELECT * FROM sample_table Where First_Name LIKE '%$searchq%' OR Last_Name LIKE '%$searchq%'";
	$count = $conn->query($sql);
	if($count->num_rows == 0){
		$output = 'There were no search records';
	}else{
		while($row = $count->fetch_assoc()){
			$fname = $row['First_Name'];
			$lname = $row['Last_Name'];
			$id = $row['id'];
			
			$output .= '<div>'.$fname.' '.$lname.'</div>';
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title> Search </title>
</head>
<h1>Search for FirstName/LastName<h1>
<body>

<form action="index.php" method="post">
	<input type="text" name="search" placeholder="Search for members" />
	<input type="submit" value="Search" /> 
</form>

<h3><?php print("$output");?><h3>

</body>
</html>