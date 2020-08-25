<?php
include_once '../../config/database.php';
require "../../jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$email = '';
$motdepasse = '';

$databaseService = new Database();
$conn = $databaseService->getConnection();



$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$motdepasse = $data->motdepasse;

$table_name = 'utilisateuradmin';

$query = "SELECT  * FROM " . $table_name . " WHERE email = ? LIMIT 0,1";

$stmt = $conn->prepare( $query );
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();

if($num > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $idAdmin = $row['idAdmin'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $created = $row['created'];
    $email2 = $row['email'];
    $contact = $row['contact'];
    $password2 = $row['motdepasse'];
    $photo = $row['photo'];

    if(password_verify($motdepasse, $password2))
    {
        $secret_key = "YOUR_SECRET_KEY";
        $issuer_claim = "THE_ISSUER"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = time(); // issued at
        $notbefore_claim = $issuedat_claim + 10; //not before in seconds
        $expire_claim = $issuedat_claim + 60; // expire time in seconds
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "exp" => $expire_claim,
            "data" => array(
                "idAdmin" => $idAdmin,
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "contact" => $contact,
                "photo" => $photo
        ));

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $email,
                "idAdmin"=>$idAdmin,
                "nom" => $nom,
                "prenom" => $prenom,
                "photo" => $photo,
                "created" => $created,
                "contact" => $contact,
                "expireAt" => $expire_claim
            ));
    }
  
    else{

        http_response_code(401);
        echo json_encode(array("message" => "Sorry! Wrong password .", "password" => $email));
    }
}
else{

    echo json_encode(array("message" => "Invalid."));
}

?>