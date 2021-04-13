<?php  

$namecontact = $_POST['namecontact'];
$emailcontact = $_POST['emailcontact'];
$phonecontact = $_POST['phonecontact'];
$messagecontact = $_POST['messagecontact'];

$db = mysqli_connect("localhost","me","me","sdi1800027");

	$query="INSERT INTO contact_form (name, email, phone, message)
	VALUES ('$namecontact' , '$emailcontact','$phonecontact','$messagecontact')";

	mysqli_query($db , $query);
	readfile('http://localhost/ministry_of_labor/info.php');





?>