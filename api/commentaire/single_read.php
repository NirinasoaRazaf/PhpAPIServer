<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/commentaire.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Commentaire($db);

    $item->idOuvrage = isset($_GET['idOuvrage']) ? $_GET['idOuvrage'] : die();
    echo('id='+$_GET['idOuvrage']);
    $item->getfichecommentairesParOuvrage();
   
    if($item->idOuvrage != null){
      
       /* $commsArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
        extract($row);*/
        $e = array(
            "idCommentaire" => $idCommentaire,
            "idMembre" => $idMembre,
                "idOuvrage" => $idOuvrage,
                "created" => $created,
                "message" => $message,
                "photo" => $photo,
                "nom" => $nom,
                "prenom" => $prenom
        
        );
        http_response_code(200);
       
      //  array_push($commsArr, $e);
       // }
        echo json_encode($e);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Auteur not found.");
    }
?>