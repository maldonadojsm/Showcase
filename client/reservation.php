<?php

//This screens displays  all available sessions for the product presentation.
ob_start(); //Initialize Buffer
session_start(); //Allows us to use session variables.
if ( $_SESSION['logged_in'] != 1 )
{
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
}
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);
//Query 1: Selects all of the sessions found in the session table.
$data=$mysqli->query("SELECT * FROM session");

?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Available Sessions</title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['action']))
    {
        $_SESSION['selected_session']=$_POST['id'];
        $_SESSION['session_date']=$_POST['iddate'];
        $_SESSION['session_time']=$_POST['idtime'];
        require 'process_reservation.php';
    }
    elseif (isset($_POST['logout']))
    {
        require 'process_logout.php';
    }
    elseif(isset($_POST['main_menu'])) //If the user presses  "Main Menu" button
    {
        //Send to main menu of client page
        header( "Location: http://localhost:8888/DatabaseProject/authenticate/menu_db.php");
    }
}
?>
<body>
<article>
    <table align="center">
        <tr>
            <td colspan="7" id="header"><h1>Available Sessions</h1></td>
        </tr>
        <tr>
            <th>Session Time</th>
            <th>Session Date</th>
            <th>Remaining Spots</th>
            <th>Reserve</th>
        </tr>
        <?php  while($user=mysqli_fetch_array($data)){?>
        <tr>
            <td><?php echo $user['time'] ?></td>
            <td><?php echo $user['date'] ?></td>
            <td><?php echo $user['spots'] ?></td>
            <td>
            <form method="post" action=""/>
            <input type="submit" name='action' id=login_btn value="Reserve"/>
            <input type="hidden" name='iddate' id=login_btn value="<?php echo $user['date'];?>"/>
            <input type="hidden" name='idtime' id=login_btn value="<?php echo $user['time'];?>"/>
            <input type="hidden" name='id' id=login_btn value="<?php echo $user['idsession'];?>"/>
            </form></td>

        <?php }?>
        </tr>
    </table>
</article>
<div id="registration">
<form method="post">
    <input name="main_menu" type="submit" id=app_btn value="Return to Main Menu" />
</form>
<form method="post">
    <input name="logout" type="submit" id=logout_btn value="Log Out" />
</form>
</div>
</body>
</html>