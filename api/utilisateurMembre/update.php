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
    
    // UtilisateurMembre values
    $item->idMembre = $data->idMembre;
    $item->motdepasse = $data->motdepasse;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateUtilisateurMembre()){
        echo json_encode("UtilisateurMembre data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>