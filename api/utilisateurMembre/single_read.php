<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/utilisateurMembre.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new UtilisateurMembre($db);

    $item->idMembre= isset($_GET['idMembre']) ? $_GET['idMembre'] : die();
  
    $item->getSingleUtilisateurMembre();

    if($item->idMembre != null){
        // create array
        $emp_arr = array(
            "idUtilisateurMembre" =>  $item->idUtilisateurMembre,
            "idMembre" => $item->idMembre,
            "email" => $item->email,
            "motdepasse" => $item->motdepasse,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("UtilisateurMembre not found.");
    }
?>