<?php

$dbConnect = array(
	'server' 	=> 'localhost',
	'user'		=> 'root',
	'pass'		=> '',
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