<?php

$dbConnect = array(
	// 'server' 	=> 'localhost',
	// 'user'		=> 'root',
	// 'pass'		=> 'admin',
	'server' 	=> 'navigatio-db.cqondar6hbwx.us-east-1.rds.amazonaws.com',
	'user'		=> 'vishnu',
	'pass'		=> 'qwerty123',
	'name'		=> 'navigatio'
	);

$db = new mysqli(
	$dbConnect['server'],
	$dbConnect['user'],
	$dbConnect['pass'],
	$dbConnect['name']
	);

if($db->connect_error>0)
{
	echo "Database connection error" . $db->connect_error;
}

?>