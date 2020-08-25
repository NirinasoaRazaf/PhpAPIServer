<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/membre.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Membre($db);

    $stmt = $items->getMembres();
    $itemCount = $stmt->rowCount();
  

    if($itemCount > 0){
        
        $membreArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idMembre" => $idMembre,
                "nom" => $nom,
                "prenom" => $prenom,
                "adresse" => $adresse,
                "filiere" => $filiere,
                "cin" => $cin,
                "delivreA" => $delivreA,
                "telephone" => $telephone,
                "domaine" => $domaine,
                "email" => $email,
                "dateNaissance" => $dateNaissance,
                "photo" => $photo,
                "codeBarre" => $codeBarre,
                "created" => $created
            );

            array_push($membreArr, $e);
        }
        echo json_encode($membreArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>