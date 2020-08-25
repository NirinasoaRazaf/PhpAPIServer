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

    $item->email = isset($_GET['email']) ? $_GET['email'] : die();
  
    $item->findUserByEmail();

    if($item->email != null){
        // create array
        $emp_arr = array(
            "idAdmin" =>  $item->idAdmin,
            "nom" => $item->nom,
            "prenom" => $item->prenom,
            "email" => $item->email,
            "contact" => $item->contact,
            "motdepasse" => $item->motdepasse,
            "photo" => $item->photo,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Admin not found.");
    }
?>