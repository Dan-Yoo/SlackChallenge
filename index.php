<?php

include 'DB_connect.php';
include 'GameBoard.php';

	$token = $_POST['token'];

	//make sure the request comes from Slack
	if ($token != 'tywWH21kkZOVWWB7tGQLbbzc') {
		die("What are you doing here >:( I only accept requests from Slack!");
	}

	$db = new DB_connect();
	$connection = $db->connect();
	
	$result = pg_query($connection, "SELECT * FROM tictactoe");

	while ($row = pg_fetch_row($result)) {
		echo $row[0];
	}
	
	//initializing phase
	$playerOne = $_POST['user_name'];
	$playerTwo = $_POST['text'];
	$channelId = $_POST['channel_id'];

	$gameBoard = new GameBoard();
	$gameBoard->initialize($playerOne, $playerTwo);




	$db->close($connection);

?>