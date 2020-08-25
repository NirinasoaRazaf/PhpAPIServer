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

    $item->idMembre = isset($_GET['idMembre']) ? $_GET['idMembre'] : die();
  
    $item->getSingleMembre();

    if($item->idMembre != null){
        // create array
        $emp_arr = array(
            "idMembre" =>  $item->idMembre,
            "nom" => $item->nom,
            "prenom" => $item->prenom,
            "adresse" => $item->adresse,
            "filiere" => $item->filiere,
            "cin" => $item->cin,
            "delivreA" => $item->delivreA,
            "telephone" => $item->telephone,
            "domaine" => $item->domaine,
            "email" => $item->email,
            "dateNaissance" => $item->dateNaissance,
            "photo" => $item->photo,
            "codeBarre" => $item->codeBarre,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Membre not found.");
    }
?>