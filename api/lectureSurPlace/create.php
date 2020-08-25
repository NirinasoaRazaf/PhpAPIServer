<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/lectureSurPlace.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new LectureSurPlace($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->idMembre = $data->idMembre;
    $item->idOuvrage = $data->idOuvrage;
    $item->DateLecture = $data->DateLecture;
    $item->created = date('Y-m-d H:i:s');
    
    
    if($item->addLectureSurPlace()){
        echo 'lectureSurPlace created successfully.';
    } else{
        echo 'lectureSurPlace could not be created.';
    }
?>