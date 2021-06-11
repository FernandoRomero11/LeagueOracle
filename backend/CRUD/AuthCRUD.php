<?php
require '../vendor/autoload.php';
include_once './DBConnection.php';
include_once './header.php';
use \Firebase\JWT\JWT;
class AuthCRUD {

    private $db = null;
    private $conn = null;

    function __construct() {
        $this->db = new DBConnection();
        $this->conn = $this->db->db_connect();
    }

    public function registry($username,$email,$password){
        if($username !== "" && $email !== "" && $password !== ""){
            $password = md5($password);
            echo($username);
            echo($email);
            echo($password);
            $query = "INSERT INTO user (username,email,password) VALUES('".$username."','".$email."','".$password."')";
            echo($query);
            $this->conn->exec($query);
        }
    }

    public function login($email,$password){
        $query = "SELECT id, username, email, password FROM user WHERE email =:email  LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $numOfRows = $stmt->rowCount();
        if($numOfRows > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $row['id'];
            $bd_username = $row['username'];
            $bd_email = $row['email'];
            $bd_pass = $row['password'];

            if(md5($password) === $bd_pass){
                $secret_key = "LeagueOracleSecretKey";
                $issuer_claim = "localhost";
                $issuedat_claim = time(); // time issued
                $expire_claim = $issuedat_claim + 60;
                $token = array(
                    "iss" => $issuer_claim,
                    "iat" => $issuedat_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "id" => $id,
                        "username" => $bd_username,
                        "email" => $bd_email,
                    ));

                $jwtValue = JWT::encode($token, $secret_key);
                return json_encode(
                    array(
                        "message" => "success",
                        "token" => $jwtValue,
                        "expiry" => $expire_claim
                    ));
            }
        }
        return json_encode(array("success" => "false"));
    }
}