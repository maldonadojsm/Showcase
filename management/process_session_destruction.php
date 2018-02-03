<?php

//This script processes the deletion of a session based on the delete button that was pressed in the manage session page

//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Store Session Variable
$session=$_SESSION['selected_session'];
//Query to process the deletion of such session based on the session of ID of the session.
$sql = "DELETE FROM session WHERE idsession='$session'";
if($mysqli->query($sql))
    header("Location: http://localhost:8888/DatabaseProject/management/manage_session.php"); //Send user back
// to the manage session page.

