<?php

header('Content-Type: application/json');

include 'DB_connect.php';
include 'TicTacToeController.php';

	//connect to database
	$db = new DB_connect();
	$GLOBALS['connection'] = $db->connect();

	$controller = new TicTacToeController();
	$token 		= $_POST['token'];
	$channelId 	= $_POST['channel_id'];
	$playerOne	= $_POST['user_name'];
	$command	= $_POST['text'];

	//verify token from Slack
	$controller->verifyToken($token);

	//displays command descriptions to the user
	if ($command == '!help') {
		$message = "Available commands: \n \"/ttt username\" to start a game against this player,\n \"/ttt display\" to show the current board state,\n \"/ttt play[row][column]\" where [row]= row and [column] = column that you want to play your move. (22 is the center of the board)";
		echo HttpHelper::genericResponse($message);
		return true;
	}
	
	//$gameExists = $controller->verifyExistingGame($GLOBALS['connection'], $channelId);

	//verifies if a game is currently being played on the users channel
	if (!$controller->verifyExistingGame($GLOBALS['connection'], $channelId)) {
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

	$db->close($GLOBALS['connection']);

	echo HttpHelper::genericResponse("Invalid command. A game is currently in progress!");
?>