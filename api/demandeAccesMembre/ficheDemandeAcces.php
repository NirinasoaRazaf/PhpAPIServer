<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/demandeAccesMembre.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new DemandeAccesMembre($db);

    $stmt = $items->getficheDemandeAcces();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $commentaireArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idDemandeAccesMembre" => $idDemandeAccesMembre,
                "idMembre" => $idMembre,
                "estValide" => $estValide,
                "motif" => $motif,
                "created" => $created,
                "nom" => $nom,
                "prenom" => $prenom,
                "photo" => $photo
            );

            array_push($commentaireArr, $e);
        }
        echo json_encode($commentaireArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>