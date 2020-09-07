<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/favori.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Favori($db);

    $item->idMembre = isset($_GET['idMembre']) ? $_GET['idMembre'] : die();
   
    $item->getnombreFavoriParMembre();
   
    if($item->idMembre != null){
      
       /* $commsArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
        extract($row);*/
        $e = array(
           
            "idMembre" => $item->$idMembre,
            "nombre" => $item->$nombre
               
        
        );
        http_response_code(200);
       
      //  array_push($commsArr, $e);
       // }
        echo json_encode($e);
    }
      
    else{
        http_response_code(404);
        echo json_encode("favori not found.");
    }
?>