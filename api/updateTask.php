<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)
    && isset($data->list_data)
    && is_numeric($data->id)
    && !empty(trim($data->list_data))
) {
    $text = $data->list_data;
    $task_id = $data->id;
    $updateUser = $db_conn->prepare("UPDATE `todolist` SET `name`=N? WHERE `id`=?");
    $updateUser->execute(array($text, $task_id));

    if ($updateUser) {
        echo json_encode(["success" => 1, "msg" => "ListData Updated."]);
    } else {
        echo json_encode(["success" => 0, "msg" => "ListData Not Updated!"]);
    }

} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}
