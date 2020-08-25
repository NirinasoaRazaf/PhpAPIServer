<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/commentaire.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Commentaire($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->idCommentaire = $data->idCommentaire;
    
    // auteur values
    $item->idMembre = $data->idMembre;
    $item->idOuvrage =$data->idOuvrage;
    $item->message = $data->message;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateCommentaire()){
        echo json_encode("auteur data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>