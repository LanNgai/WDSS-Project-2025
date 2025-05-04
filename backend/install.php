<?php

//To install database with all information using init.sql
require "config.php";

try {
    $connection = new PDO("mysql:host=$host", $user, $password, $options);

    $sql = file_get_contents("../data/init.sql");
    $connection->exec($sql);
    echo "Database and table users created successfully.";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
