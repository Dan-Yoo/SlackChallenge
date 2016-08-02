<?php

include 'DB_connect.php';
include 'GameBoard.php';

	$token = $_POST['token'];

	//make sure the request comes from Slack
	if ($token != 'tywWH21kkZOVWWB7tGQLbbzc') {
		echo 'What are you doing here >:( I only accept requests from Slack!';
	}

	//initializing phase

	$playerOne = $_POST['user_name'];
	$playerTwo = $_POST['text'];
	$gameBoard = new GameBoard();
	$gameBoard->initialize($playerOne, $playerTwo);

	$db = new DB_connect();
	$db->connect();
    
	
	echo "connected successfully!";

?>