<?php  




	if (isset($_POST['submit_but'])) {

	
		//conect with the database
		$db = mysqli_connect("localhost","me","me","sdi1800027");
		mysqli_set_charset($db,"utf8");
		$name = $_POST['name'];
		$pass = $_POST['pass'];

		if(empty($name) || empty($pass))
		{

			echo "<script>
             				alert('Συμπληρώστε όλα τα πεδία!'); 
             				window.history.go(-2);
     							</script>";
						
						exit();
			exit();
		}
		else{

			$sql = "SELECT * FROM ministry_users WHERE username = ?";
			$stmt = mysqli_stmt_init($db);
			if(!mysqli_stmt_prepare($stmt, $sql)){

				echo "<script>
             				alert('Error'); 
             				window.history.go(-2);
     							</script>";
						
						exit();
			}
			else{

				mysqli_stmt_bind_param($stmt, "s", $name );
				mysqli_stmt_execute($stmt);
				$results = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($results)){

					//if we have a user! :)
					$passcheck = password_verify($pass, $row['pass']);
					if ($passcheck == false) {

						echo "<script>
             				alert('Wrong Password'); 
             				window.history.go(-2);
     							</script>";
						exit();
					}
					else if($passcheck == true){

						session_start();
						$_SESSION['username'] = $row['username'];
						$_SESSION['afm'] = $row['afm'];
						$_SESSION['role'] = $row['role'];
						$_SESSION['bussiness_id'] = $row['bussiness_id'];
						

						//readfile('http://localhost/ministry_of_labor/ministry.php');
						echo "<script>
             				alert('Συνδεθήκατε επιτυχώς !'); 
             				window.history.go(-2);
     							</script>";
						
						exit();
					}
					else{

						echo "<script>
             				alert('Error'); 
             				window.history.go(-2);
     							</script>";
						exit();
					}

				}
				else{
					echo "<script>
             				alert('Error'); 
             				window.history.go(-2);
     							</script>";
						exit();
					//header("Location: login.php?error=notin");
					//no user
				}
			}

		}
	}
	else{
		readfile('http://localhost/ministry_of_labor/ministry.php');


}
?>