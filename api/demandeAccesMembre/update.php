<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/demandeAccesMembre.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new DemandeAccesMembre($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->idDemandeAccesMembre = $data->idDemandeAccesMembre;
    
    // auteur values
  
    $item->estValide =$data->estValide;
 
    
    if($item->updateDemandeAccesMembre()){
        echo json_encode("DemandeAccesMembre  updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>