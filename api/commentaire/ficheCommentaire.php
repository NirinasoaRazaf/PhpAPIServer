<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/commentaire.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Commentaire($db);

    $stmt = $items->getfichecommentaires();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $commsArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idMembre" => $idMembre,
                "idOuvrage" => $idOuvrage,
                "created" => $created,
                "message" => $message,
                "photo" => $photo,
                "nom" => $nom,
                "prenom" => $prenom
                
            );

            array_push($commsArr, $e);
        }
        echo json_encode($commsArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>