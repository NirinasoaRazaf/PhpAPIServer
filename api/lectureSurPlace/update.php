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
    
    $item->idLectureSurPlace = $data->idLectureSurPlace;
    
    // LectureSurPlace values
    $item->idMembre = $data->idMembre;
    $item->idOuvrage = $data->idOuvrage;
    $item->DateLecture =  $data->DateLecture;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateLectureSurPlace()){
        echo json_encode("LectureSurPlace data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>