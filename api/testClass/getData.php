<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/TestClass.php';

    $database = new database();
    $db = $database->getConnection();

    $data = new Test($db);

    $allData = $data->getData();
    $itemCount = $allData->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["data"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $allData->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $result = array(
                "id" => $id,
                "name" => $name,
                "email" => $email
            );

            array_push($employeeArr["data"], $result);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>