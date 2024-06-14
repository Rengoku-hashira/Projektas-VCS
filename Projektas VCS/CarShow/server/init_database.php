<?php
global $connection;
include 'database.php';

$sql = "CREATE TABLE IF NOT EXISTS visitors (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL UNIQUE,
    car_manufacturer VARCHAR(30) NOT NULL,
    car_model VARCHAR(30) NOT NULL,
    car_build_year int(4) NOT NULL,
    car_engine_capacity INT(4) NOT NULL,
    car_engine_power_kw INT(4) NOT NULL,
    license_plate_number VARCHAR(10) NOT NULL,
    car_modifications TEXT(225) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($connection->query($sql) === TRUE) {
    echo "Table visitors created successfully";
} else {
    echo "Error creating table: " . $connection->error;
}

$connection->close();
