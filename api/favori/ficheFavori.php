<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/favori.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Favori($db);

    $stmt = $items->getficheFavoris();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $commsArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idMembre" => $idMembre,
                "idOuvrage" => $idOuvrage,
                "created" => $created,
                "description" => $description,
                "photo" => $photo,
                "titre" => $titre,
                "nomAuteur" => $nomAuteur,
                "nomGenre" => $nomGenre,
                "langue" => $langue
                
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