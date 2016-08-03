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
		echo $controller->initializeGame($GLOBALS['connection'], $playerOne, $command, $channelId);

		return true;
	}

	//commands
	if (substr($command, 0, 4) == 'play') {
		echo $controller->playMove($GLOBALS['connection'], $playerOne, $channelId, $command);
		return true;
	}

	if ($command == 'display') {
		echo $controller->displayBoard($connection, $channelId);
		return true;
	}



	//echo "\n END";

	$db->close($GLOBALS['connection']);

	$array = array(
		"response_type" => "in_channel",
		"text" => "HELLO EVERYONE"
	);

	echo json_encode($array);
?>