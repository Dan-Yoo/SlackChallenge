<?php

include 'DB_connect.php';

	$token = $_POST['token'];

	echo $token;

	$db = new DB_connect();
	$db->connect();
    
	
	echo "connected successfully!";

?>