<?php

$databaseCredentials = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => 'admin',
    'database' => 'carproject',
    'port' => '3306'
);

$connection = new mysqli(
    $databaseCredentials['host'],
    $databaseCredentials['username'],
    $databaseCredentials['password'],
    $databaseCredentials['database'],
    $databaseCredentials['port']
);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
