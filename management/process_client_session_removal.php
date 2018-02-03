<?php
//This file continues the client removal process of a particular session (based on parameters from the modify session
//screen.


//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Store Session Variables
$idclient=$_SESSION['idclient'];
$sessionid=$_SESSION['sesid'];

//Query 1: Updates current remaining spots for such session
$updates_spots="UPDATE session SET spots=spots+1 WHERE idsession=$idsession";
//Query 2: Delete such client from the session using his client ID
$sql = "DELETE FROM reservation WHERE clientid='$idclient'";
//Query Execution:
if($mysqli->query($sql)) //If Query has been successful
{
    //Execute update query
    $mysqli->query($updates_spots);
    header("Location: http://localhost:8888/DatabaseProject/management/modify_session.php"); //Send manager
    // back to the modify session page.
}
