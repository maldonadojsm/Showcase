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

$hour=$_SESSION['hour'];
$date=$_SESSION['date'];

$info=$mysqli->query("SELECT * FROM session where time='$hour' AND date='$date'")

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
        header( "Location: http://localhost:8888/DatabaseProject/management/management_menu_db.php");
    }
}
?>
<body>
<article>
    <table align="center">
        <tr>
            <td colspan="7" id="header"><h1> Session Successfully Created </h1></td>
        </tr>
        <?php  while($user=mysqli_fetch_array($info)){?>
            <tr>
                <th scope="row">Session ID:</th>
                <td><?php echo $user['idsession'] ?></td>
            </tr>
            <tr>
                <th scope="row">Date:</th>
                <td><?php echo $user['date'] ?></td>
            </tr>
            <tr>
                <th scope="row">Time:</th>
                <td><?php echo $user['time'] ?></td>
            </tr>
            <tr>
                <th scope="row">Spots:</th>
                <td><?php echo $user['spots'] ?></td>
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