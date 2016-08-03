<?php

class DB_Connect
{
    public function connect()
    {
        $url     = "postgres://almwanyyyjcqvw:2vUmD01T4vMeT768uOHk61Cfyc@ec2-54-243-249-137.compute-1.amazonaws.com:5432/d2e1gs12pvg3so";
        $host        = "host=ec2-54-243-249-137.compute-1.amazonaws.com";
        $port        = "port=5432";
        $dbname      = "dbname=d2e1gs12pvg3so";
        $credentials = "user=almwanyyyjcqvw password=2vUmD01T4vMeT768uOHk61Cfyc";

        $db = pg_connect( "$host $port $dbname $credentials"  );

        if(!$db){
           //echo "Error : Unable to open database\n";
        } else {
           //echo "Opened database successfully\n";
        }
        return $db;
    }

    public function close($connection)
    {
        pg_close($connection);
    }

}

?>