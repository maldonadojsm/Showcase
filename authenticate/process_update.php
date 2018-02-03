<?php
//This script is used to process any account information (except email, PW and ID) that the user has updated within the application

session_start(); //Allows to use session variables

//Connects to the DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);



//Stores session variables
$first_name=$_SESSION['fn'];
$last_name=$_SESSION['ln'];
$email=$_SESSION['em'];
$telephone=$_SESSION['tele'];
$idclient=$_SESSION['id_client'];



//Process update of client information via query
$sql = "UPDATE client SET first_name = '$first_name', last_name = '$last_name', email = '$email', telephone = '$telephone'
WHERE idclient = $idclient";
if($mysqli->query($sql))
    header("Location: http://localhost:8888/DatabaseProject/authenticate/account_summary.php"); //Success
else
    header("Location: http:/localhost:8888/DatabaseProject/authenticate/update_error.php");//failure.

