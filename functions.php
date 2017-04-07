<?php 
	
//function to display chatlog
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


?>