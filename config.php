<?php
// Database configuration for Sweet Delights Bakery
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'bakery_db';

// Suppress mysqli exceptions and report clean JSON on failure
mysqli_report(MYSQLI_REPORT_OFF);
$mysqli = @new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Database connection failed.',
        'details' => $mysqli->connect_error
    ]);
    exit();
}

return $mysqli;
