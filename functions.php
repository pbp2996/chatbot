<?php 
	
//function to display chatlog via chat tabel
function getchatlog() {
	include('database.php');

	$statement = $db->prepare('SELECT * FROM chat');
    $statement->execute(); 
	$chats = $statement->fetchall();
	$statement->closeCursor();

	return $chats;
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

//functino to get current step 
function get_current_step(){
	include('database.php');	
	$statement = $db->prepare("SELECT * FROM pizzabot.steps
								WHERE completed = 'N'
								ORDER BY stepid ASC
								LIMIT 1;");
    $statement->execute(); 
	$step = $statement->fetch();
	$statement->closeCursor();

	$currentstep = $step['stepid'];
	return $currentstep;
}

function next_step($step_num){
	include('database.php');

	$query = "UPDATE steps SET completed= 'Y' WHERE stepid = :step_num;";
	$statement = $db->prepare($query);
	$statement->bindValue(':step_num', $step_num);
	$statement->execute();
	$statement->closeCursor();	
}

//to go through user string
function search_through_and_respond($input) {
	include('database.php');
	
	$response = "";
	//step 1 validation - to add order 

		$currentstep = get_current_step(); 

			if (($currentstep == 1) && ((strpos($input,"order now") !== false) || (strpos($input,"place order") !== false) || (strpos($input,"order pizza") !== false))) {
				$response = "Lets do it, hit me with that order when you are ready...";
				$step_num = $currentstep;
				next_step($step_num);

			} else {
				$response = "sorry we already did that";
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