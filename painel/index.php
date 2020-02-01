<?php
session_start();
require 'config.php';
require 'vendor/autoload.php';
Core\Core::getInstance()->run();