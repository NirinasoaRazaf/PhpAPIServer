<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/database.php';
    include_once '../class/utilisateurMembre.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new UtilisateurMembre($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->idUtilisateurMembre = $data->idUtilisateurMembre;
    
    
    if($item->deleteUtilisateurMembre()){
        echo json_encode("UtilisateurMembre deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>