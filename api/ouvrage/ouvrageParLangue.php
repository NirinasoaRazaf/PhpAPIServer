<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/ouvrage.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Ouvrage($db);

    $stmt = $items->ouvrageParLangue();
    $itemCount = $stmt->rowCount();
  

    if($itemCount > 0){
        
        $ouvrageArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "langue" => $langue,
                "nombre" => $nombre
          
            );

            array_push($ouvrageArr, $e);
        }
        echo json_encode($ouvrageArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>