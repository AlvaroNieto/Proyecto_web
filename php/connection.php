<?php
$connection = new mysqli("url", "user", "password", "dbname");
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
$acentos = $connection->query("SET NAMES 'utf8'");
 ?>
