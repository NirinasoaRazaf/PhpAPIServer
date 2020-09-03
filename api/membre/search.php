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
 
  
    $query = "SELECT * FROM Membre WHERE
     nom LIKE '%$wordToSearch%' OR email LIKE '%$wordToSearch%'   
    OR prenom LIKE '%$wordToSearch%'  OR telephone LIKE '%$wordToSearch%' 
    OR idMembre LIKE '%$wordToSearch%' OR cin LIKE '%$wordToSearch%'
    OR dateNaissance LIKE '%$wordToSearch%' OR adresse LIKE '%$wordToSearch%'
    OR delivreA LIKE '%$wordToSearch%' OR filiere LIKE '%$wordToSearch%'  
    OR domaine LIKE '%$wordToSearch%' 
       ";

    $stmt = $conn->prepare( $query );
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count == 0){
        echo json_encode(array("message" => "Could not find data."));
    }else{
        $auteurArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $email = $row['email'];
            $photo = $row['photo'];
            $created = $row['created'];
            $codeBarre = $row['codeBarre'];
            $dateNaissance = $row['dateNaissance'];
            $domaine = $row['domaine'];
            $cin = $row['cin'];
            $telephone = $row['telephone'];
            $delivreA = $row['delivreA'];
            $idMembre = $row['idMembre'];
            $filiere = $row['filiere'];
            $adresse = $row['adresse'];
           
            
       
             extract($row);
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

           array_push($auteurArr, $e);
        }
        echo json_encode($auteurArr);
        }
       
    }
    else{
        $query = "SELECT * FROM fichelecturesp ";
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $count = $stmt->rowCount();
      
        $auteurArr = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $email = $row['email'];
            $photo = $row['photo'];
            $titre = $row['titre'];
            $nomAuteur = $row['nomAuteur'];
            $dateLecture = $row['dateLecture'];
            $idLectureSurPlace = $row['idLectureSurPlace'];
            $idMembre = $row['idMembre'];
           
            
       
             extract($row);
            $e = array(
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "photo" => $photo,
                "titre" => $titre,
                "nomAuteur" => $nomAuteur,
                "dateLecture" => $dateLecture,
                "idLectureSurPlace" => $idLectureSurPlace,
                "idMembre" => $idMembre
         

           );

           array_push($auteurArr, $e);
        }
        echo json_encode($auteurArr);
        }

?>