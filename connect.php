<?php
$host = 'localhost';
$db = 'db_uastekweb';
$user = 'root';
$password = '';




$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];
	$pdo = new PDO($dsn, $user, $password);

	

} catch (PDOException $e) {
	echo $e->getMessage();
}

session_start();