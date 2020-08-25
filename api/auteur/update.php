<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/auteur.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Auteur($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->idAuteur = $data->idAuteur;
    
    // auteur values
    $item->nomAuteur = $data->nomAuteur;
    $item->dateNaissance =$data->dateNaissance;
    $item->nationalite = $data->nationalite;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateAuteur()){
        echo json_encode("auteur data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>