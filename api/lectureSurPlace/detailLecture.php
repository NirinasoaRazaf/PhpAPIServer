<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/lectureSurPlace.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new LectureSurPlace($db);

    $item->idOuvrage = isset($_GET['idOuvrage']) ? $_GET['idOuvrage'] : die();
  
    $stmt = $item->detailLecture();
     $itemCount = $stmt->rowCount();

    if($itemCount>0){
        $emp_arr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
               "nom" => $nom,
                "prenom" => $prenom,
                "dateLecture" => $dateLecture,
                "photo" => $photo
            );

            array_push($emp_arr, $e);
        }
      
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("lectureSurPlace not found.");
    }
?>