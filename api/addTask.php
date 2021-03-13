<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->list_data) && !empty(trim($data->list_data))) {

    $data = $data->list_data;
    $insertList = $db_conn->prepare("INSERT INTO `todolist`(`name`) VALUES(N?)");
    $insertList->execute([$data]);
    if ($insertList) {
        $last_id = $db_conn->lastInsertId();
        echo json_encode(["success" => 1, "msg" => "ListData Inserted.", "id" => $last_id]);
    } else {
        echo json_encode(["success" => 0, "msg" => "ListData Not Inserted!"]);
    }

} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}
