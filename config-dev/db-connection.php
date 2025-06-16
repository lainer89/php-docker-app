<?php
$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

if (!$host || !$user || !$pass || !$name) {
    die("Database environment variables are not set.");
}

return new PDO(
    "mysql:host=$host;dbname=$name",
    $user,
    $pass,
    [PDO::ATTR_PERSISTENT => true]
);
