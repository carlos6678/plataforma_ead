<?php
global $db;
define("BASE","http://localhost/ead/system_chat/");
define("BASE_PRINCIPAL",'http://localhost/ead/');
try{
    $db=new PDO("mysql:dbname=ead;host=localhost","root","");
}catch(PDOExeption $e){
    echo $e;
}