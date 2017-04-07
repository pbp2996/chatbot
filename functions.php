<?php 
	
//function to display chatlog via chat tabel
function getchatlog() {
	include('database.php');

	{
	$statement = $db->prepare('SELECT * FROM chat');
    $statement->execute(); 
	$chats = $statement->fetchall();
	$statement->closeCursor();

	return $chats;

	}
}

//to add user input into chat tabel
function adduserinput($input) {
	include('database.php');
	$query ="";
	{
    $query = 'INSERT INTO chat
                 (input, `text`, img)
              VALUES
                 ("user", :input, "user" )';
    $statement = $db->prepare($query);
    $statement->bindValue('input', $input);
    $statement->execute();
    $statement->closeCursor();
	}
}

//to clear chat bot if user has not typed anything
function clearchat() {
	include('database.php');
	$query ="";
	{
	    $query = 'TRUNCATE TABLE chat;';
	    $statement = $db->prepare($query);
	    $statement->execute();
	    $statement->closeCursor();
	}

	{
    $query = 'INSERT INTO chat
                 (input, `text`, img)
              VALUES
                 ("bot", "Hi, I am PizzaBot", "bot" )';
	    $statement = $db->prepare($query);
	    $statement->execute();
	    $statement->closeCursor();
	}

}

//to go through user string
function search_through_and_respond($input) {
	include('database.php');
	global $currentstep;
	
	$response = "";
	//step 1 validation - to add order 

		if ($currentstep == "currentstep"){
			if ((strpos($input,"order now") !== false) || (strpos($input,"place order") !== false) || (strpos($input,"order pizza") !== false)) {
				$currentstep = "menu";
				$response = "Lets do it, hit me with that order when you are ready...";
			} else {
				$response = "sorry we already did that";
			}
		}

    $query = 'INSERT INTO chat
                 (input, `text`, img)
              VALUES
                 ("bot", :response, "bot" )';
	$statement = $db->prepare($query);
	$statement->bindValue(':response', $response);
	$statement->execute();
	$statement->closeCursor();	
	
}



?>