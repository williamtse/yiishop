<?php
$dsn = "mysql:dbname=yiishop;host=127.0.0.1";
$user = "root";
$passwd = "";
header("Content-type:text/html;charset=gbk");
try {
    $dbh = new PDO($dsn, $user, $passwd);var_dump($dbh);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

