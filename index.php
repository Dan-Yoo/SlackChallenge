<?php

include 'DB_connect.php';
include 'TicTacToeController.php';

	$token = $_POST['token'];

	//make sure the request comes from Slack
	if ($token != 'tywWH21kkZOVWWB7tGQLbbzc') {
		die("What are you doing here >:( I only accept requests from Slack!");
	}

	//connect to database
	$db = new DB_connect();
	$GLOBALS['conn'] = $db->connect();
	
	//check if channel id exists in db. If it doesnt, initialize one!
	$channelId = $_POST['channel_id'];
	$query = "SELECT * FROM public.tictactoe WHERE channel_id = " . $channelId;
	$result = pg_query($GLOBALS['conn'], $query);

	$row = pg_fetch_row($result);

	if (empty($row)) {
		echo "channel id not found";
	}

	echo "channel id foudn";
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