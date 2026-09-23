<?php

require_once 'database.php';

$database = new Database();
$db = $database->getConnection();

header('Content-Type: application/json');

if ($db) {
    echo json_encode([
        "status" => "success",
        "message" => "Database connected successfully"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
}
?>