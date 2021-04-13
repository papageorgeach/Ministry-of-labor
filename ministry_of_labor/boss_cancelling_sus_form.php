<?php 
	session_start();
	$afm = $_POST['afmcansus'];
	$boss_buss_id= $_SESSION['bussiness_id'];

	$db = mysqli_connect("localhost","me","me","sdi1800027");


	$sql = "SELECT * FROM ministry_users WHERE afm = ?";
	$stmt = mysqli_stmt_init($db);
	if(!mysqli_stmt_prepare($stmt, $sql)){

		readfile('http://localhost/ministry_of_labor/boss.php');
		//header("Location: login.php?error=sqlerror");
		exit();
	}
	else{

		mysqli_stmt_bind_param($stmt, "s", $afm );
		mysqli_stmt_execute($stmt);
		$results = mysqli_stmt_get_result($stmt);
		if($row = mysqli_fetch_assoc($results)){
			$emp_buss_id=$row['bussiness_id'];
		}
		else{
			echo "<script>
             	alert('Δεν υπάρχει τέτοιος εργαζόμενος'); 
             	window.history.go(-2);
     			</script>";

		}
	}

	if($emp_buss_id == $boss_buss_id ){
		$query="DELETE FROM users_data WHERE kind = '1' AND afm = '$afm'";

		mysqli_query($db , $query);
		echo "<script>
             	alert('H αναστολή ακυρώθηκε με επυτιχία'); 
             	window.history.go(-2);
     			</script>";
     }
     else{
     	echo "<script>
             	alert('Δεν έχετε δικαίομα πάνω σε αυτον τον εργαζόμενο'); 
             	window.history.go(-2);
     			</script>";
     }

	
?>