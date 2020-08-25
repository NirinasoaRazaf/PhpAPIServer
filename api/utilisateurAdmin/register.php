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

    $item->nom = $data->nom;
    $item->prenom = $data->prenom;
    $item->email = $data->email;
    $item->contact = $data->contact;
    $item->motdepasse = $data->motdepasse;
    $item->photo = $data->photo;
    $item->created = date('Y-m-d H:i:s');

    
    if($item->addUtilisateurAdmin()){
        echo 'UtilisateurAdmin created successfully.';
    } else{
        echo 'UtilisateurAdmin could not be created.';
    }
?>