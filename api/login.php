<?php 

// required headers
// header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../config/config.php";
include "../helper/Token.php";
include "../helper/ResponseFormatter.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST)){
        // echo json_encode($_POST);die;
        $username   = $_POST['username'];
        $password   = $_POST['password'];

        $query = $mysqli->query("SELECT * FROM user WHERE username = '$username'");

        if($query->num_rows <= 0){
            ResponseFormatter::error(null, "Username tidak terdaftar.",401);
        }
        else{
            $user = $query->fetch_assoc();
            if($user['role'] == "ADMIN"){
                ResponseFormatter::error(null, "Wewenang tidak sesuai. ");
            }
            elseif(password_verify($password, $user['password'])){
                
                $token = Token::key();
                $mysqli->query("UPDATE user SET token='$token' WHERE id=$user[id]");
                $query = $mysqli->query("SELECT * FROM user WHERE username = '$username'");
                $user = $query->fetch_assoc();
                $token = $user['token'];
                unset($user['password']);
                unset($user['token']);

                ResponseFormatter::success(["user"=>$user, "access_token" => $token], "Login berhasil.");
            }else{
                ResponseFormatter::error(null, "Username dan password tidak sesuai.", 401);
            }
        }
        
    }
}
else 
{
    ResponseFormatter::error(null, "Method tidak sesuai.", 405);
}
$mysqli->close();

?>