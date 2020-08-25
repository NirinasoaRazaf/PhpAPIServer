<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/ouvrage.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Ouvrage($db);

    $item->titre = isset($_GET['titre']) ? $_GET['titre'] : die();
  
    $item->findIdByColumn();

    if($item->titre != null){
        // create array
        $emp_arr = array(
            "idOuvrage" => $item->idOuvrage,
            "idAuteur" => $item->idAuteur,
            "titre" => $item->titre,
            "editeur" => $item->editeur,
            "nombrePage" => $item->nombrePage,
            "prix" => $item->prix,
            "idGenre" => $item->idGenre,
            "langue" => $item->langue,
            "anneeEdition" => $item->anneeEdition,
            "dateEntree" => $item->dateEntree,
            "quantite" => $item->quantite,
            "etatActuel" => $item->etatActuel,
            "origine" => $item->origine,
            "lieuEdition" => $item->lieuEdition,
            "description" => $item->description,
            "codeBarre" => $item->codeBarre,
            "created" => $item->created,
            "photo" => $item->photo
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Ouvrage not found.");
    }
?>