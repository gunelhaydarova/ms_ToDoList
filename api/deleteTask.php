<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';
$data = json_decode(file_get_contents("php://input"));
if (isset($data->id)
    && is_numeric($data->id)) {
    $delID = $data->id;

    $deleteListData = $db_conn->prepare("DELETE FROM `todolist` WHERE `id`=?");
    $deleteListData->execute([$delID]);

    if ($deleteListData) {
        echo json_encode(["success" => 1, "msg" => "ListData Deleted"]);
    } else {
        echo json_encode(["success" => 0, "msg" => "ListData Not Found!"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "List Not Found!"]);
}
