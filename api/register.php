<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include "../config/config.php";
include "../helper/ResponseFormatter.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST))
    {
        $nama       = $_POST['nama'];
        $username   = $_POST['username'];
        $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email      = $_POST['email'];
        $no_hp      = $_POST['no_hp'];
        $alamat     = $_POST['alamat'];

        $query = $mysqli->query("SELECT * FROM user WHERE username = '$username'");
        if($query->num_rows > 0)
        {
            ResponseFormatter::error(null, "Username telah digunakan");
        }
        else
        {

            $query = $mysqli->query("INSERT INTO user (
                nama,
                username,
                password,
                email,
                no_hp,
                alamat
            ) VALUES (
                '$nama',
                '$username',
                '$password',
                '$email',
                '$no_hp',
                '$alamat'
            )");
            // var_dump($query);die;
            if($query)
            {
                ResponseFormatter::success($query, "Pendaftaran berhasil.");
            }else
            {
                ResponseFormatter::error(null, "Gagal Melakukan Pendaftaran");

            }
        }
        
        
    }
}
else {
    ResponseFormatter::error(null, "Method tidak sesuai.", 405);
}
$mysqli->close();
?>