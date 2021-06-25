<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/StudentClass.php';

    $database = new Database();
    $db = $database->getConnection();

    $data = new Student($db);
    $data->id = isset($_GET['id']) ? $_GET['id'] : die();
    $data->getSingleData();

    if($data->name != null){
        // create array
        $data = array(
            "id" =>  $data->id,
            "name" => $data->name,
            "batch" => $data->batch
        );
      
        http_response_code(200);
        echo json_encode($data);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Data not found.");
    }
?>