<?php

//This script processes the reservation confirmation based on the parameter entered by the manager in the
//modify session page.

//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Store session variable
$client=$_SESSION['idclient'];


//Process the update
$sql = "UPDATE reservation SET confirmation = 'Y' WHERE clientid = $client ";
if($mysqli->query($sql))
    header("Location: http://localhost:8888/DatabaseProject/management/modify_session.php");
else
    header("Location: http://localhost:8888/DatabaseProject/management/process_update_confirmation_error.php");//failure. West: I haven't built a page for this