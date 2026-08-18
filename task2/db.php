<?php
// Database connection settings - adjust as needed for your environment
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'task2';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    // Use a simple message for local development
    die('Database connection failed: ' . $mysqli->connect_error);
}

// Optional: set charset
$mysqli->set_charset('utf8mb4');
?>