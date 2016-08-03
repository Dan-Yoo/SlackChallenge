<?php

header('Content-Type: application/json');

include 'DB_connect.php';
include 'TicTacToeController.php';

	$controller = new TicTacToeController();
	
	$token 		= $_POST['token'];
	$channelId 	= $_POST['channel_id'];
	$playerOne	= $_POST['user_name'];
	$command	= $_POST['text'];

	//verify token from Slack
	//$controller->verifyToken($token);

	//connect to database
	$db = new DB_connect();
	$GLOBALS['connection'] = $db->connect();
	
	$gameExists = $controller->verifyExistingGame($GLOBALS['connection'], $channelId);

	if (!$gameExists) {
		$controller->initializeGame($GLOBALS['connection'], $playerOne, $command, $channelId);

		return true;
	}

	echo "There is a board for this channel already \n\n";

	//check if the user entering command is the dude that has to play next.

	//commands
	if (substr($command, 0, 4) == 'play') {
		$controller->playMove($GLOBALS['connection'], $playerOne, $channelId, $command);
	}

	if ($command == 'display') {
		$controller->displayBoard($connection, $channelId);
	}



	echo "\n END";

	$db->close($GLOBALS['connection']);

	$array = array(
		"text" => "HELLO EVERYONE"
	);

	echo json_encode($array);
?>