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
 
  
    $query = "SELECT * FROM nombreCommentaireParOuvrage WHERE idOuvrage=$idOuvrage";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
      
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $idOuvrage = $row['idOuvrage'];
            $nombre = $row['nombre'];
           
            
       
             extract($row);
            $e = array(
                "idOuvrage" => $idOuvrage,
                "nombre" => $nombre
         

           );

       
        }
        echo json_encode($e);
        }
       
    }
    else{
        http_response_code(404);
        echo json_encode("not found.");
    
    }
?>