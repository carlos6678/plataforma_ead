<?php
session_start();
require "config.php";
require "vendor/autoload.php";
$Core=new Core\Core();
$Core->run();