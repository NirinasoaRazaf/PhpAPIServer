<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/genres.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Genres($db);

    $item->nomGenre = isset($_GET['nomGenre']) ? $_GET['nomGenre'] : die();
  
    $item->findIdByColumn();

    if($item->idGenre != null){
        // create array
        $emp_arr = array(
            "idGenre" =>  $item->idGenre,
            "nomGenre" => $item->nomGenre,
            "description" => $item->description,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Genre not found.");
    }
?>