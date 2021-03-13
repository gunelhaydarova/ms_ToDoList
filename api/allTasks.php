<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$stmt = $db_conn->prepare("SELECT * FROM `todolist`");
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $all_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["success" => 1, "ListData" => $all_data]);
} else {
    echo json_encode(["success" => 0]);
}
