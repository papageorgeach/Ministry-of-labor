<?php  
	
	$namedate = $_POST['namedate'];
	$emaildate = $_POST['emaildate'];
	$phonedate = $_POST['phonedate'];
	$time = $_POST['time'];
	$messagedate = $_POST['messagedate'];

	$db = mysqli_connect("localhost","me","me","sdi1800027");
	$query="INSERT INTO dates (name, email, phone, dates_date,reasoning)
	VALUES ('$namedate', '$emaildate','$phonedate','$time','$messagedate')";

	mysqli_query($db , $query);
	readfile('http://localhost/ministry_of_labor/date.php');

?>