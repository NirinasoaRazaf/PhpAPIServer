<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/utilisateurAdmin.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new UtilisateurAdmin($db);

    $stmt = $items->getUtilisateurAdmins();
    $itemCount = $stmt->rowCount();
  

    if($itemCount > 0){
        
        $utilisateurAdminArr = array();
 

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "idAdmin" => $idAdmin,
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "contact" => $contact,
                "motdepasse" => $motdepasse,
                "photo" => $photo,
                "created" => $created
            );

            array_push($utilisateurAdminArr, $e);
        }
        echo json_encode($utilisateurAdminArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>