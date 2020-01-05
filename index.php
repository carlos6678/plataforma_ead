<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';
$core = new Core\Core();
$core->run();