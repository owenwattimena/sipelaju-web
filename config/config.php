<?php 
/**
 * https://www.000webhost.com/cpanel-login
 * email : enchadelima98@gmail.com
 * pass : Enchadelima98
 * --------------------------------------
 * 000webhost.com
 * DATABASE
 * pass : {E1{DLn4#3XvOk&w 
 */

$host = "localhost";
$username = "root";
$password = "";
$database = "sipelaju";

$mysqli = new mysqli("$host","$username","$password","$database");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

?>