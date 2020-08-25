<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../class/utilisateurAdmin.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new UtilisateurAdmin($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->idAdmin = $data->idAdmin;
    $item->nom = $data->nom;
    $item->prenom = $data->prenom;
    $item->email = $data->email;
    $item->contact = $data->contact;
    $item->photo = $data->photo;
    $item->motdepasse = $data->motdepasse;
    $item->created = date('Y-m-d H:i:s');
    
    if($item->updateUtilisateurAdmin()){
        echo json_encode("UtilisateurAdmin data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>