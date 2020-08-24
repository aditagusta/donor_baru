<?php
require 'vendor/autoload.php';

// Using Medoo namespace
use Medoo\Medoo;
$_DEBUG = true;
// Initialize
$con = new Medoo([
	'database_type' => 'mysql',
	'database_name' => 'db_donor_baru',
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'mysql'
]);
