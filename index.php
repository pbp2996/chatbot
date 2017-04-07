<?php 
	require_once('database.php');
	require_once('functions.php')
?>

<?php

//Adds user input to chat tabel 
	if(isset($_POST['submit'])) {
		$input = filter_input(INPUT_POST,'input', FILTER_SANITIZE_STRING);
			adduserinput($input);
			search_through_and_respond($input);
	}else {
		$currentstep = "start";
	}

	echo $currentstep;

//clear chat log
	if(isset($_POST['clearbutton'])) {
	clearchat();
	$currentstep = "start";
	}


//this will display the chat
	$chats = getchatlog();

?>


<!DOCTYPE html>
<html>
<head>
	<title>PizzaBot </title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Pangolin|Roboto" rel="stylesheet">
</head>
<body>


	<div class="title">
		<center><h2>PizzaBot</h2></center>
	</div>

	<div class="main">
		<div class="chatlog">
<!--Loop to generate chat records-->
			<?php foreach ($chats as $chat) { ?>
				<div class="response">
					<div class="img">
						<img src="images/<?php echo $chat['img'] ?>.png" height="50px" width="50px" >
					</div>
					<div class="res">
						<p><?php echo $chat['text']; ?></p>
					</div>
				</div><hr> 
			<?php } ?>	


		</div>
		<div class="userinput">
			<form action="index.php" method="post">
				<input required class="inputbox" type="text" name="input" style="background-color: rgba(245, 245, 245, .4)">
				<input class="inputbutton" type="submit" name="submit" value="Enter">
			</form>
		</div>

	</div>




		<div class="footer">		
			<form action="index.php" method="post">
				<input class="clearbutton" type="submit" name="clearbutton" value="Clear">
			</form>
			<h3 style="	font-size: 20px;">- by Parth Patel</h3>
		</div>	

</body>
</html>