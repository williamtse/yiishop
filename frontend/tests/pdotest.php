<?php
$dsn = "mysql:host=127.0.0.1;dbname=yii2advanced";
$user = "root";
$passwd = "123456";
$pod = new PDO($dsn,$user,$passwd);
var_dump($pod);

