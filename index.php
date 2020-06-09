<?php

  $config = [
     "server"     => "127.0.0.1:3306",
     "username"   => "root",
     "password"   => ""  
  ];

  header('Content-type: application/json');

  @$link = new mysqli($config['server'],$config['username'],$config['password']);
  
  $timestamp = time();
  
  if ($link->connect_errno) {
    http_response_code(503);
	echo("Server URL: ");
	echo($config['server']);
	echo "\n";
    echo("Server Status: Unable to connect - Unavailable");
	echo "\n";
	echo("Timestamp: ");
	echo(date("F d, Y h:i:s A", $timestamp));
  }
  else {
    http_response_code(200);
    echo("Server URL: ");
	echo($config['server']);
	echo "\n";
	echo("Server Status: Connection successful - Available");
	echo "\n";
	echo("Timestamp: ");
	echo(date("F d, Y h:i:s A", $timestamp));
  }
?>

