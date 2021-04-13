<?php  

if (isset($_POST['submit'])) {
	
	//conect with the database
	$db = mysqli_connect("localhost","me","me","sdi1800027");

	//if connection fails ->prosses ends
	if(!$db)
	{
		die("Conection failed :".mysqli_connect_error());
	}
	//puting values to variables 
	$role = $_POST['select'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$afm = $_POST['afm'];
	$amka = $_POST['amka'];
	$fathers = $_POST['fathers'];
	$bussnum = $_POST['bussnum'];
	$mail = $_POST['mail'];
	$user_name = $_POST['user_name'];
	$pass = $_POST['pass'];
	$reppass = $_POST['reppass'];

	if ($pass !== $reppass) {
		echo "string1";

		header("http://localhost/ministry_of_labor/acount_creation.php?error=passwordcheck&uid=" .$user_name ."&mail". $mail );
		exit();
	}
	else{

		$sql = "SELECT username FROM ministry_users WHERE username = ?";
		$stmt = mysqli_stmt_init($db);

		if(!mysqli_stmt_prepare( $stmt, $sql)){
			echo "<script>
             				alert('Error'); 
             				window.history.go(-2);
     							</script>";
						exit();
			exit();

		}
			//checking if there is already a user with this usename!
		else{


			mysqli_stmt_bind_param($stmt, "s", $user_name);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0){
				echo "<script>
             				alert('username alrady taken'); 
             				window.history.go(-2);
     							</script>";
				exit();
			}
			else{


				$sql="INSERT INTO ministry_users (afm, role, first_name, last_name, fathers_name, amka, mail, username, pass, bussiness_id)
					VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($db);

				if(!mysqli_stmt_prepare( $stmt, $sql)){

					header("http://localhost/ministry_of_labor/acount_creation.php?errorsqlerror");
					exit();
				}
				else{

					$hashedpass = password_hash($pass, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ssssssssss", $afm, $role, $name ,$lastname ,$fathers ,$amka ,$mail ,$user_name ,$hashedpass ,$bussnum );
					mysqli_stmt_execute($stmt);

					echo "<script>
             				alert('Ο χρήστης δημιουργήθηκε επιτυχώς'); 
             				window.history.go(-2);
     							</script>";
					exit();
					
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($db);
	exit();
}
else{


	readfile('http://localhost/ministry_of_labor/ministry.php');
	exit();
}