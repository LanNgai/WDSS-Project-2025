<?php
//To connect to database by PDO object and using database details stored in config.php
require 'config.php';
try {
    $conn = new PDO($dsn, $user, $password, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
