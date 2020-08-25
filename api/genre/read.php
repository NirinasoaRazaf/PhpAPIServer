<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/genres.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Genres($db);

    $stmt = $items->getGenres();
    $itemCount = $stmt->rowCount();


   

    if($itemCount > 0){
        
        $genreArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idGenre" => $idGenre,
                "nomGenre" => $nomGenre,
                "description" => $description,
                "created" => $created
            );

            array_push($genreArr, $e);
        }
        echo json_encode($genreArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>