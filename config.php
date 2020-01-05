<?php
global $db;
define('BASE','http://localhost/ead/');
try{
	$db=new PDO('mysql:dbname=ead;host=localhost','root','');
}catch(PDOExeption $e){
	echo $e;
}