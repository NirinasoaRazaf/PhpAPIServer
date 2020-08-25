<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/utilisateurMembre.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new UtilisateurMembre($db);

    $stmt = $items->getUtilisateurMembres();
    $itemCount = $stmt->rowCount();
  

    if($itemCount > 0){
        
        $utilisateurMembreArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idUtilisateurMembre" => $idUtilisateurMembre,
                "idMembre" => $idMembre,
                "motdepasse" => $motdepasse,
                "email" => $email,
                "created" => $created
                
            );

            array_push($utilisateurMembreArr, $e);
        }
        echo json_encode($utilisateurMembreArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>