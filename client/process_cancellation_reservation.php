<?php
// Connects to DB in order to process query
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Assigns session variables in order to accurately delete reservation
$idsession=$_SESSION['idsession'];
$date=$_SESSION['iddate'];
$time=$_SESSION['idtime'];
$user=$_SESSION['idclient'];


//Query 1: Update spots of a said session if the client has pressed cancel
$updates_spots="UPDATE session SET spots=spots+1 WHERE idsession=$idsession";
//Query 1: Delete client's reservation from the Reservation table that corresponds to the variables initialized above.
$sql = "DELETE FROM reservation WHERE clientid='$user' AND idsession='$idsession' AND date='$date' AND time='$time'";
if($mysqli->query($sql)) //If query successful. Process Query 1:
{
    $mysqli->query($updates_spots);
    //Return to Account Summary Page (Now not showing a reservation id for the such client).
    header("Location: http://localhost:8888/DatabaseProject/authenticate/account_summary.php");
}


