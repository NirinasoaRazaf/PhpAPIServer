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
$idMembre = isset($_GET['idMembre']) ? $_GET['idMembre'] : die();

if ($idMembre!=null){
 
  
    $query = "SELECT DISTINCT * FROM ficheFavori WHERE idMembre=$idMembre order by created desc";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $auteurArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nombre = $row['nombre'];
            $idFavori = $row['idFavori'];
            $idMembre = $row['idMembre'];
            $idOuvrage = $row['idOuvrage'];
            $created = $row['created'];
            $description = $row['description'];
            $photo = $row['photo'];
            $titre = $row['titre'];
            $nomAuteur = $row['nomAuteur'];
            $nomGenre = $row['nomGenre'];
            $langue = $row['langue'];
       
             extract($row);
            $e = array(
                "nombre" => $nombre,
                "idFavori" => $idFavori,
                "idMembre" => $idMembre,
                "idOuvrage" => $idOuvrage,
                "created" => $created,
                "description" => $description,
                "photo" => $photo,
                "titre" => $titre,
                "nomAuteur" => $nomAuteur,
                "nomGenre" => $nomGenre,
                "langue" => $langue
         

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