<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/membre.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Membre($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->nom = $data->nom;
    $item->prenom = $data->prenom;
    $item->adresse = $data->adresse;
    $item->filiere = $data->filiere;
    $item->cin = $data->cin;
    $item->delivreA = $data->delivreA;
    $item->telephone = $data->telephone;
    $item->domaine = $data->domaine;
    $item->email = $data->email;
    $item->dateNaissance = date('Y-m-d H:i:s',strtotime($data->dateNaissance));
    $item->photo = $data->photo;
    $item->codeBarre = $data->codeBarre;
    $item->created = date('Y-m-d H:i:s');
    
    
    if($item->addMembre()){
        echo 'Membre created successfully.';
    } else{
        echo 'Membre could not be created.';
    }
?>