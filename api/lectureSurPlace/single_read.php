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

    $item->idLectureSurPlace = isset($_GET['idLectureSurPlace']) ? $_GET['idLectureSurPlace'] : die();
  
    $item->getSingleLectureSurPlace();

    if($item->idMembre != null){
        // create array
        $emp_arr = array(
            "idLectureSurPlace" =>  $item->idLectureSurPlace,
            "idMembre" => $item->idMembre,
            "idOuvrage" => $item->idOuvrage,
            "DateLecture" => $item->DateLecture,
            "created" => $item->created
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("lectureSurPlace not found.");
    }
?>