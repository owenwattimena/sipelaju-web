<?php 
// required headers
// header("Access-Control-Allow-Origin: http://localhost/rest-api-authentication-example/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "../config/config.php";
include "../helper/ResponseFormatter.php";
/**
 * 
 * Request Method GET
 * 
 */
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['user'])){
            $id_user = $_GET['user'];
    
            $query = $mysqli->query("SELECT * FROM laporan WHERE id_user=$id_user");
            if($query){
    
                $result = $query->fetch_all(MYSQLI_ASSOC);
                ResponseFormatter::success(["reports" => $result], "sukses");
            }else{
                ResponseFormatter::error(null, "Data tidak ada");
            }
        }
        else{
            $query = $mysqli->query("SELECT * FROM laporan");
            if($query){
    
                $result = $query->fetch_all(MYSQLI_ASSOC);
                ResponseFormatter::success(["reports" => $result], "sukses");
            }else{
                ResponseFormatter::error(null, "Data tidak ada");
            }
        }
        break;
    case 'POST':
        if($_POST != null){
            $id_user     = $_POST['id_user'];
            $lokasi      = $_POST['lokasi'];
            $keterangan  = $_POST['keterangan'];
            $latitude    = $_POST['latitude'];
            $longitude   = $_POST['longitude'];
            $tanggal     = $_POST['tanggal'];
            $foto        = $_FILES['file'];
            $status      = $_POST['status'];
    
            // UPLOAD FOTO
            $target_dir = realpath(dirname(__DIR__)) . "/storage/";
            $file = explode('.', $foto["name"]);
            $foto_baru = uniqid() . "." . end($file);
            $target_file = $target_dir . $foto_baru;
            // Memeriksa keaslian gambar
            if(isset($foto)){
                if($foto['tmp_name'] == null){
                    ResponseFormatter::error(null, "Gambar yang anda masukan bermasalah. \nUkuran gambar Min. 2MB");
                    return;
                }
                $check = getimagesize($foto["tmp_name"]);
                if($check == false) {
                    ResponseFormatter::error(null, "Masukan gambar yang benar.");
                }else{
                    if (file_exists($target_file)) {
                        ResponseFormatter::error(null, "Gambar sudah pernah di upload.");
                    }else{
                        // Check file size
                        if ($foto["size"] > 2000000) {
                            ResponseFormatter::error(null, "Ukuran gambar terlalu beasar.");
                        }
                        else{
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            // Allow certain file formats
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                ResponseFormatter::error(null, "Mohon masukan file dengan format gambar.");
                            }
                            else{
                                if (move_uploaded_file($foto["tmp_name"],  $target_file)) {
                                    $query = $mysqli->query("INSERT INTO laporan (
                                        id_user,
                                        lokasi,
                                        keterangan,
                                        latitude,
                                        longitude,
                                        tanggal,
                                        foto,
                                        status
                                    ) VALUES (
                                        '$id_user',
                                        '$lokasi',
                                        '$keterangan',
                                        '$latitude',
                                        '$longitude',
                                        '$tanggal',
                                        '$foto_baru',
                                        '$status'
                                    )");
                                    // var_dump($mysqli);
                                    if($query){
                                        ResponseFormatter::success($query, "Laporan terkirm.");
                                    }else{
                                        ResponseFormatter::error(null, "Laporan tidak terkirim.");
                                    }
                                } else {
                                    ResponseFormatter::error(null, "Laporan tidak terkirim. Gambar bermasalah.");
                                }
                            }
                        }
                    } 
                }
            }
            else{
                ResponseFormatter::error(null, "File tidak boleh kosong.");
            }
        }
        else{
            ResponseFormatter::error(null, "Request body kosong.");
        }
        break;
    
    default:
        ResponseFormatter::error(null, "Method tidak sesuai.", 405);
        break;
}
$mysqli->close();

?>