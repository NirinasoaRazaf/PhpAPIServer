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

    $item->idAuteur = isset($_GET['idAuteur']) ? $_GET['idAuteur'] : die();
  
    $item->getSingleAuteur();

    if($item->idAuteur != null){
        // create array
        $emp_arr = array(
            "idAuteur" =>  $item->idAuteur,
            "nomAuteur" =>  $item->nomAuteur,
            "dateNaissance" => $item->dateNaissance,
            "nationalite" => $item->nationalite,
            "created" => $item->created
        
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Auteur not found.");
    }
?>