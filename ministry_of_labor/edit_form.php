<?php  
	session_start();
	if (isset($_POST['submit'])){
		$new_un = $_POST['user_namec'];
		$new_pw = $_POST['passc'];
		$new_email = $_POST['emailc'];
		$afm = $_SESSION["afm"];
		
		$db = mysqli_connect("localhost","me","me","sdi1800027");
		if (!empty($new_email)){
			$query="UPDATE ministry_users SET mail = '" . $new_email . "'  WHERE afm = '" . $afm . "'";
			mysqli_query($db , $query);
		}
		if (!empty($new_un)){
			$query="UPDATE ministry_users SET username = '" . $new_un . "'  WHERE afm = '" . $afm . "'";
			mysqli_query($db , $query);
		}
		if (!empty($new_pw)){
			$hashedpass = password_hash($new_pw, PASSWORD_DEFAULT);
			$query="UPDATE ministry_users SET pass = '" . $hashedpass . "'  WHERE afm = '" . $afm . "'";
			mysqli_query($db , $query);
		}
		

		echo "<script>
             				alert('Η ενέργεια πραγματοποιήθηκε με επιτυχία!'); 

             				window.history.go(-2);
     							</script>";
						
						exit();
	}
	echo "<script>
             				alert('Η ενέργεια δεν πραγματοποιήθηκε'); 
             				window.history.go(-2);
     							</script>";

?>