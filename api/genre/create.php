<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/genres.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Genres($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nomGenre = $data->nomGenre;
    $item->description = $data->description;
    $item->created = date('Y-m-d H:i:s');
    
    
    if($item->addGenre()){
        echo 'Genre created successfully.';
    } else{
        echo 'Genre could not be created.';
    }
?>