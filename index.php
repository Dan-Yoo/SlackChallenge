<?php

include 'DB_connect.php';
include 'TicTacToeController.php';

	$controller = new TicTacToeController();
	
	$token 		= $_POST['token'];
	$channelId 	= $_POST['channel_id'];
	$playerOne	= $_POST['user_name'];
	$playerTwo	= $_POST['text'];

	//verify token from Slack
	//$controller->verifyToken($token);
	echo $channelId;
	//connect to database
	$db = new DB_connect();
	$GLOBALS['connection'] = $db->connect();
	
	$gameExists = $controller->verifyExistingGame($GLOBALS['connection'], $channelId);

	if (!$gameExists) {
		$controller->initializeGame($GLOBALS['connection'], $playerOne, $playerTwo, $channelId);

		return true;
	}

	echo "There is a board for this channel already";

	$db->close($GLOBALS['connection']);

?>