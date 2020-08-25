<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/lectureSurPlace.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new LectureSurPlace($db);

    $stmt = $items->getFicheLectureSurPlaces();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $lectureSurPlaceArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "photo" => $photo,
                "titre" => $titre,
                "nomAuteur" => $nomAuteur,
                "dateLecture" => $dateLecture,
                "idLectureSurPlace" => $idLectureSurPlace,
                "idMembre" => $idMembre

            );

            array_push($lectureSurPlaceArr, $e);
        }
        echo json_encode($lectureSurPlaceArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>