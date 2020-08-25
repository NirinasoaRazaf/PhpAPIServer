<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/favori.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Favori($db);

    $stmt = $items->getFavoris();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $commentaireArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idFavori" => $idFavori,
                "idMembre" => $idMembre,
                "idOuvrage" => $idOuvrage,
               "created" => $created
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