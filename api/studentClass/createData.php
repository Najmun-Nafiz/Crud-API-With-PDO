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
    $request = json_decode(file_get_contents("php://input"));

    $data->name = $request->name;
    $data->batch = $request->batch;
    
    if($data->createData()){
        echo 'Data created successfully.';
    } else{
        echo 'Data could not be created.';
    }
?>