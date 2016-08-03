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

	//connect to database
	$db = new DB_connect();
	$connection = $db->connect();
	
	$gameExists = $controller->verifyExistingGame($connection, $channelId);

	if (!$gameExists) {
		$controller->initializeGame($connection, $playerOne, $playerTwo, $channelId);

		return true;
	}

	echo "There is a board for this channel already";
	// while ($row = pg_fetch_row($result)) {
	// 	echo $row[0] . $row[1] . $row[2];
	// 	echo $row['channel_id'];
	// 	print_r($row);
	// }
	
	// //initializing phase
	// $playerOne = $_POST['user_name'];
	// $playerTwo = $_POST['text'];
	// $channelId = $_POST['channel_id'];

	// $gameBoard = new GameBoard();
	// $gameBoard->initialize($playerOne, $playerTwo);




	$db->close($GLOBALS['conn']);

?>