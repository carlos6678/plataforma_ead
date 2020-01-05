<?php

global $db;
define('BASE','http://localhost/ead/painel/');
define('BASE_PRINCIPAL','http://localhost/ead/');
define('ROOT', 1);
try{
	$db=new PDO("mysql:dbname=ead;host=localhost","root","");
}catch(PDOExeption $e){
	echo $e;
}
