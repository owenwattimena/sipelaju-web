<?php 
session_start();
if(!isset($_SESSION['loged']))header('location:../'); 

include "../config/config.php";

if(!isset($_GET['page'])){
  $query1 = $mysqli->query("SELECT * FROM laporan WHERE status='DITERIMA'");
  $query2 = $mysqli->query("SELECT * FROM laporan WHERE status='DIPERIKSA'");
  $query3 = $mysqli->query("SELECT * FROM laporan WHERE status='DITOLAK'");
  $query4 = $mysqli->query("SELECT * FROM laporan WHERE status='SELESAI'");
  $query5 = $mysqli->query("SELECT * FROM user WHERE role='USER'");

  $data['total_diterima']  = $query1->num_rows;
  $data['total_diperiksa'] = $query2->num_rows;
  $data['total_ditolak']   = $query3->num_rows;
  $data['total_selesai']   = $query4->num_rows;
  $data['total_user']      = $query5->num_rows;
  include 'dashboard/index.php';
}else{

  if($_GET['page'] == 'report'){
    if(!isset($_GET['id'])){
      $query = $mysqli->query("SELECT 
      l.id, 
      l.id_user, 
      l.foto, 
      l.lokasi, 
      l.keterangan, 
      l.latitude, 
      l.longitude, 
      l.tanggal, 
      l.status, 
      u.username 
      FROM laporan AS l JOIN user AS u ON l.id_user=u.id ORDER BY l.tanggal DESC");
      $data['laporan'] = $query->fetch_all(MYSQLI_ASSOC);
      // var_dump($data['laporan']);die;
      include 'report/index.php';
    }
    else if(isset($_GET['id'])){
      
      if($_GET['id'] != null)
      {
        $id = $_GET['id'];

        if(isset($_GET['action'])){
          if($_GET['action'] == 'delete'){
            $query = $mysqli->query("SELECT * FROM laporan WHERE id=$id");
            if($query->num_rows > 0){
              $report = $query->fetch_assoc();
              unlink("../storage/" . $report['foto']);
              $delete = $mysqli->query("DELETE FROM laporan WHERE id=$id");
              header("location:index.php?page=report");
            }
          }
          else{
            header("location:index.php?page=report");
          }
        }

  
        if(isset($_POST['tolak'])){
          $query = $mysqli->query("UPDATE laporan SET status='DITOLAK' WHERE id=$id");
          header("location:index.php?page=report");
        }
        if(isset($_POST['periksa'])){
          $query = $mysqli->query("UPDATE laporan SET status='DIPERIKSA' WHERE id=$id");
          header("location:index.php?page=report");
        }
        if(isset($_POST['selesai'])){
          $query = $mysqli->query("UPDATE laporan SET status='SELESAI' WHERE id=$id");
          header("location:index.php?page=report");
        }
  
        $query = $mysqli->query("SELECT 
          l.id, 
          l.id_user, 
          l.foto, 
          l.lokasi, 
          l.keterangan, 
          l.latitude, 
          l.longitude, 
          l.tanggal, 
          l.status, 
          u.username 
          FROM laporan AS l JOIN user AS u ON l.id_user = u.id WHERE l.id=$id");
        $data['laporan'] = $query->fetch_assoc();
        include 'report/detail.php';
      }

    }

  }
  else if($_GET['page'] == 'users'){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      if($id != null){
        if(isset($_GET['action'])){
          if($_GET['action'] == 'delete'){
            $query = $mysqli->query("DELETE FROM user WHERE id=$id AND role='USER'");
            if($query){
              
            }
          }
        }
      }
    }
    $query           = $mysqli->query("SELECT * FROM user WHERE role='USER'");
    $data['users']   = $query->fetch_all(MYSQLI_ASSOC);
    include 'users/index.php';
  }
  else if($_GET['page'] == 'profil'){
    $id              = $_SESSION['loged']['user']['id'];
    if(isset($_POST['submit']))
    {
      $nama            = $_POST['nama'];
      $username        = $_POST['username'];
      $query           = $mysqli->query("UPDATE user SET nama='$nama', username='$username' WHERE id=$id");
      if($query){
        header('location:logout.php');
      }
    }
    else if(isset($_POST['submit-password']))
    {
      $password        = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $query           = $mysqli->query("UPDATE user SET password='$password' WHERE id=$id");
      if($query){
        header('location:logout.php');
      }
    }
    include 'profil/index.php';
  }
  else{

  }
}
$mysqli->close();
?>