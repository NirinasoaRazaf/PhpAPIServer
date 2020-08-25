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
    
    // Ouvrage values
    $item->idAuteur = $data->idAuteur;
    $item->titre = $data->titre;
    $item->editeur = $data->editeur;
    $item->nombrePage = $data->nombrePage;
    $item->prix = $data->prix;
    $item->idGenre = $data->idGenre;
    $item->langue = $data->langue;
    $item->anneeEdition = $data->anneeEdition;
    $item->dateEntree = $data->dateEntree;
    $item->quantite = $data->quantite;
    $item->etatActuel = $data->etatActuel;
    $item->origine = $data->origine;
    $item->lieuEdition = $data->lieuEdition;
    $item->description = $data->description;
    $item->codeBarre = $data->codeBarre;
    $item->created = date('Y-m-d H:i:s');
    $item->photo = $data->photo;
    
    if($item->updateOuvrage()){
        echo json_encode("Ouvrage data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>