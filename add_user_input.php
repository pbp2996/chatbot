<?php 
	include('database.php');
	include('functions.php');

	if(isset($_POST['submit'])) {
		$input = filter_input(INPUT_POST,'input', FILTER_SANITIZE_STRING);
		$input = htmlspecialchars($input);
		{
			adduserinput($input);
			include('logic.php');
		}
	}

    header('Location: .');
    exit();
?>