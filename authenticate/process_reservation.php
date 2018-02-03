<?php

session_start(); //Allows to use session variables
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Initialize variables to store session information
$idsession=$_SESSION['selected_session'];
$date=$_SESSION['session_date'];
$time=$_SESSION['session_time'];
$client=$_SESSION['id_client'];

//Process insertion of client's reservation in the Reservation Table.
$result=$mysqli->query("SELECT * from reservation where clientid='$client'");
if($result->num_rows >0) // if there is a one row within the reservation table that has the same session ID as the one selected by user..
{
    $_SESSION['message']='User already has a reservataion for that session';
    header("Location: http://localhost:8888/DatabaseProject/authenticate/reservation_error.php"); //West: I haven't built this page.
}
else {
    $sql = "INSERT INTO reservation(clientid,idsession,date,time,confirmation)"
        ."VALUES('$client','$idsession','$date','$time','N')";


    //Updates the remaining amount of vacancies in the session that the client has  placed a reservation for.
    $updates_spots="UPDATE session SET spots=spots-1 WHERE idsession=$idsession";


    if($mysqli->query($sql)) //If insertion of reservation within table has been succesful
    {
        $mysqli->query($updates_spots);
        header("Location: http://localhost:8888/DatabaseProject/authenticate/reservation_confirmation_screen.php");
    }

    else //
    {
        //West: I haven't built this page.
        header("Location: http://localhost:8888/DatabaseProject/authenticate/reservation_error.php");
        echo "Registration Failed! ";
    }
}