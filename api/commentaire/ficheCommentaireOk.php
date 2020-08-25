<?php
include_once '../../config/database.php';
require "../../jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$databaseService = new Database();
$conn = $databaseService->getConnection();
$idOuvrage = isset($_GET['idOuvrage']) ? $_GET['idOuvrage'] : die();

if ($idOuvrage!=null){
 
  
    $query = "SELECT * FROM fichecommentaire WHERE idOuvrage=$idOuvrage order by created desc";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $auteurArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $idCommentaire = $row['idCommentaire'];
            $idMembre = $row['idMembre'];
            $idOuvrage = $row['idOuvrage'];
            $created = $row['created'];
            $message = $row['message'];
            $photo = $row['photo'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
           
            
       
             extract($row);
            $e = array(
                "idCommentaire" => $idCommentaire,
                "idMembre" => $idMembre,
                    "idOuvrage" => $idOuvrage,
                    "created" => $created,
                    "message" => $message,
                    "photo" => $photo,
                    "nom" => $nom,
                    "prenom" => $prenom
         

           );

           array_push($auteurArr, $e);
        }
        echo json_encode($auteurArr);
        }
       
    }
    else{
        http_response_code(404);
        echo json_encode("Auteur not found.");
    
    }
?>