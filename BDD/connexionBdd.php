<?php
error_reporting(0);
session_start();
$host='localhost';
$db = 'hitechlab';
$username = 'postgres';
$password = 'cjpst2613';

$dns = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

try{
    $conn = new PDO($dns);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //if($conn)        echo 'bien connecter';
} catch (Exception $ex) {
echo $ex->getMessage();
}
?>


