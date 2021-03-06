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
 
  
    $query = "SELECT * FROM Membre WHERE email='$wordToSearch'";
    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $e = array(
                "idMembre" => $dataRow['idMembre'],
                "nom" =>  $dataRow['nom'],
                "prenom" =>  $dataRow['prenom'],
                "adresse" =>  $dataRow['adresse'],
                "filiere" =>  $dataRow['filiere'],
                "cin" =>  $dataRow['cin'],
                "delivreA" =>  $dataRow['delivreA'],
                "telephone" =>  $dataRow['telephone'],
                "domaine" =>  $dataRow['domaine'],
                "email" =>  $dataRow['email'],
                "dateNaissance" =>  $dataRow['dateNaissance'],
                "photo" =>  $dataRow['photo'],
                "codeBarre" => $dataRow['codeBarre'],
                "created" =>  $dataRow['created']
         

           );

           echo json_encode($e);
        }
       
        
       
    }
    else{
        echo json_encode("Membre not found.");
        }
    

?>