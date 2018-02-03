<?php
//This script processes the creation of a session based on the parameters enter by the manager in the create_session_db
//file.

//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';

$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Proctects Database from SQL injections

$hour=$mysqli->escape_string($_POST['hour']);
$date=$mysqli->escape_string($_POST['date']);
$spots=$mysqli->escape_string($_POST['spots']);

//Query to process the insertion of the session in the session Table.
$result=$mysqli->query("SELECT * FROM session WHERE time='$hour' AND date='$date'");

if($result->num_rows>0) // Prohibits creating an existing session.
{
    header("Location: http://localhost:8888/DatabaseProject/management/session_exists_error.php"); //West: I haven't created a page for this.
}
else { //If this session does not exist within the table.
    $sql = "INSERT INTO session(time,date,spots)"
        ."VALUES('$hour','$date','$spots')";
    if($mysqli->query($sql))
    {
        $_SESSION['hour']=$hour;
        $_SESSION['date']=$date;
        header("Location: http://localhost:8888/DatabaseProject/management/session_creation_confirmation_screen.php"); // Registration successful
    }
    else
    {
        header("Location: http://localhost:8888/DatabaseProject/management/session_creation_error.php"); //West: Same here.
        echo "Registration Failed! "; //Registration Failed
    }
}
