<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/lectureSurPlace.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new LectureSurPlace($db);

    $stmt = $items->getLectureSurPlaces();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $lectureSurPlaceArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idLectureSurPlace" => $idLectureSurPlace,
                "idMembre" => $idMembre,
                "idOuvrage" => $idOuvrage,
                "DateLecture" => $DateLecture,
                "created" => $created
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