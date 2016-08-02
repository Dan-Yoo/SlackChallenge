<?php

use DB_connect;

	echo extension_loaded('pgsql') ? 'yes':'no';

	// # This function reads your DATABASE_URL configuration automatically set by Heroku
	// # the return value is a string that will work with pg_connect
	// function pg_connection_string() {
	//   return "dbname=d2e1gs12pvg3so host=ec2-54-243-249-137.compute-1.amazonaws.com port=5432 user=almwanyyyjcqvw password=2vUmD01T4vMeT768uOHk61Cfyc sslmode=require";
	// }

 // 	$url 		 = "postgres://almwanyyyjcqvw:2vUmD01T4vMeT768uOHk61Cfyc@ec2-54-243-249-137.compute-1.amazonaws.com:5432/d2e1gs12pvg3so";
	// $host        = "host=ec2-54-243-249-137.compute-1.amazonaws.com";
 //    $port        = "port=5432";
 //    $dbname      = "dbname=d2e1gs12pvg3so";
 //    $credentials = "user=almwanyyyjcqvw password=2vUmD01T4vMeT768uOHk61Cfyc";

 //      $db = pg_connect( "$host $port $dbname $credentials"  );
 //      if(!$db){
 //         echo "Error : Unable to open database\n";
 //      } else {
 //         echo "Opened database successfully\n";
 //      }
 //      return $db;
	$db = new DB_connect();

	$db->connect();
    
	
	echo "connected successfully!";

?>