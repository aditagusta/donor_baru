<?php
// If you installed via composer, just use this code to require autoloader on the top of your projects.
require 'vendor/autoload.php';

// Using Medoo namespace
use Medoo\Medoo;

// Initialize
$con = new Medoo([
	'database_type' => 'mysql',
	'database_name' => 'db_donor_baru',
	'server' => 'localhost',
	'username' => 'root',
	'password' => ''
]);
