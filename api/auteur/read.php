<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/auteur.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Auteur($db);

    $stmt = $items->getAuteurs();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $auteurArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idAuteur" => $idAuteur,
                "nomAuteur" => $nomAuteur,
                "dateNaissance" => $dateNaissance,
                "nationalite" => $nationalite,
                "created" => $created
            );

            array_push($auteurArr, $e);
        }
        echo json_encode($auteurArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>