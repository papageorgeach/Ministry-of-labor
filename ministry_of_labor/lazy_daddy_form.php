<?php  

session_start();
	if (isset($_POST['submit']))
  	{	
		$afm = $_SESSION['afm'];
		$startdate = $_POST['date_from_parents'];
		$enddate = $_POST['date_to_parents'];
		$kind=0; 
		$db = mysqli_connect("localhost","me","me","sdi1800027");
		$query="INSERT INTO users_data (afm, kind, start_of, end_of)
		VALUES ('$afm', '$kind','$startdate','$enddate');";

		mysqli_query($db , $query);

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