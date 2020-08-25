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
$data = json_decode(file_get_contents("php://input"));
$wordToSearch=$data->wordToSearch;
if ($wordToSearch!=null){
 
  
    $query = "SELECT * FROM Auteur WHERE nomAuteur LIKE '%$wordToSearch%' OR nationalite LIKE '%$wordToSearch%'";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $auteurArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $idAuteur = $row['idAuteur'];
            $nomAuteur = $row['nomAuteur'];
            $dateNaissance = $row['dateNaissance'];
            $nationalite = $row['nationalite'];
           
            
       
             extract($row);
            $e = array(
                "idAuteur" => $idAuteur,
                "nomAuteur" => $nomAuteur,
                "dateNaissance" => $dateNaissance,
                "nationalite" => $nationalite
         

           );

           array_push($auteurArr, $e);
        }
        echo json_encode($auteurArr);
        }
       
    }
    else{
        $query = "SELECT * FROM auteur ";
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $count = $stmt->rowCount();
      
            $auteurArr = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $idAuteur = $row['idAuteur'];
                $nomAuteur = $row['nomAuteur'];
                $dateNaissance = $row['dateNaissance'];
                $nationalite = $row['nationalite'];
               
                
           
                 extract($row);
                $e = array(
                    "idAuteur" => $idAuteur,
                    "nomAuteur" => $nomAuteur,
                    "dateNaissance" => $dateNaissance,
                    "nationalite" => $nationalite
             
    
               );
    
               array_push($auteurArr, $e);
            }
            echo json_encode($auteurArr);
            }
    

?>