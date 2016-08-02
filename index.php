<?php
	echo 'hello';

	// # This function reads your DATABASE_URL configuration automatically set by Heroku
	// # the return value is a string that will work with pg_connect
	function pg_connection_string() {
	  return "dbname=d2e1gs12pvg3so host=ec2-54-243-249-137.compute-1.amazonaws.com port=5432 user=almwanyyyjcqvw password=2vUmD01T4vMeT768uOHk61Cfyc sslmode=require";
	}
 
	// # Establish db connection
	// $db = pg_connect(pg_connection_string());
	// if (!$db) {
	//     echo "Database connection error."
	//     exit;
	// }
 
	// $result = pg_query($db, "SELECT statement goes here");

?>