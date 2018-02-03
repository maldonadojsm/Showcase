<?php
//This page provides an overall summary of all reservations placed by the clients.
//Each client is identified by their client ID, the session they have reserved for ,the reservation ID for
//such session and their contact information.
ob_start();
session_start();
if ( $_SESSION['logged_in'] != 1 )
{
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
}
//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Select all clients who have placed a reservation for a session
$data=$mysqli->query("SELECT * FROM client,reservation WHERE client.idclient=reservation.clientid");

?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Session </title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<body>
<article>
    <table align="center">
        <tr>
            <td colspan="8" id="header"><h1>Session's Attendee Information</h1></td>
        </tr>
        <tr>
            <th>Session ID:</th>
            <th>Reservation ID:</th>
            <th>Client ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Business Name</th>
            <th>Telephone</th>
            <th>Email</th>
        </tr>
        <?php  while($user=mysqli_fetch_array($data)){?>
        <tr>
            <td><?php echo $user['idsession'] ?></td>
            <td><?php echo $user['idreservation'] ?></td>
            <td><?php echo $user['clientid'] ?></td>
            <td><?php echo $user['first_name'] ?></td>
            <td><?php echo $user['last_name'] ?></td>
            <td><?php echo $user['business_name'] ?></td>
            <td><?php echo $user['telephone'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <?php }?>
        </tr>

    </table>

</article>
</body>
</html>