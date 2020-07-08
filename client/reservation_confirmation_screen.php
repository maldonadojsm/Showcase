<?php
ob_start(); //Initialize buffer to process headers
session_start(); //Allows us to use sesison variables

//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);

//Query 1: Queries and stores  reservation information related to session chosen by user.
$user=$_SESSION['id_client'];
$session=$_SESSION['selected_session'];
$info=$mysqli->query("SELECT * FROM reservation where clientid=$user")

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Account Summary</title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['main_menu']))
    {
      header( "Location: http://localhost:8888/DatabaseProject/authenticate/menu_db.php");
    }
}
?>
<body>
<article>
    <table align="center">
        <tr>
            <td colspan="7" id="header"><h1>Reservation Confirmation Details:</h1></td>
        </tr>
        <?php  while($user=mysqli_fetch_array($info)){?>
            <tr>
                <th scope="row">Reservation ID:</th>
                <td><?php echo $user['idreservation'] ?></td>
            </tr>
            <tr>
                <th scope="row">Date:</th>
                <td><?php echo $user['date'] ?></td>
            </tr>
            <tr>
                <th scope="row">Time:</th>
                <td><?php echo $user['time'] ?></td>
            </tr>
        <?php }?>
    </table>
</article>
<div id="registration">
    <form method="post">
        <input name="main_menu" type="submit" id=registration_btn value="Return To Main Menu" />
    </form>
</div>
</body>
</html>