<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/ouvrage.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Ouvrage($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->idOuvrage = $data->idOuvrage;
    $item->etatActuel = $data->etatActuel;
   
    
    if($item->updateEtatOuvrage()){
        echo json_encode("Ouvrage data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>