<?php
date_default_timezone_set('Asia/Jakarta');
require 'vendor/autoload.php';

// Using Medoo namespace
use Medoo\Medoo;
$_DEBUG = false;
// Initialize
$con = new Medoo([
	'database_type' => 'mysql',
	'database_name' => 'mandanon_donor',
	'server' => 'localhost',
	'username' => 'mandanon_donor',
	'password' => 'donordarah12345'
]);
