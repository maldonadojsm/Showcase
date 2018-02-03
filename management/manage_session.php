<?php
//This page displays all existing  sessions to the user ; indicating the id session, date, time and spots of each session.
//Each session will have two buttons: manage and delete
//Pressing the manage button will allow the manager to independently access the client information related to each session.
//Pressing the delete button will destroy the session(completely wipes it  from the Session Table in the Database).

ob_start(); //Initialize buffer
session_start();
//Allows us to use session variables
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

//Query to select all existing session within the Session Table
$data=$mysqli->query("SELECT * FROM session");

?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Sessions</title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') //Process actions based on which buttons are pressed
{
    if(isset($_POST['manage'])) //If manage button has been pressed
    {
        $_SESSION['selected_session']=$_POST['id'];
        header("Location: http://localhost:8888/DatabaseProject/management/modify_session.php");//Redirect to
        //individual page of a session particular session
    }
    else if(isset($_POST['delete'])) //If delete button has been pressed
    {
        $_SESSION['selected_session']=$_POST['id'];
        require 'process_session_destruction.php'; //Process the destruction of selected session.
    }
    elseif (isset($_POST['logout']))
    {
        require 'process_logout.php';
    }
    elseif(isset($_POST['main_menu'])) //If the return to main menu button has been pressed
    {
        header("Location: http://localhost:8888/DatabaseProject/management/management_menu_db.php");
    }
}
?>
<body>
<article>
    <table align="center">
        <tr>
            <td colspan="7" id="header"><h1>Sessions</h1></td>
        </tr>
        <tr>
            <th>Session ID</th>
            <th>Session Time</th>
            <th>Session Date</th>
            <th>Remaining Spots</th>
            <th></th>
            <th></th>
        </tr>
        <?php  while($session=mysqli_fetch_array($data)){?>
        <tr>
            <td><?php echo $session['idsession']?></td>
            <td><?php echo $session['time'] ?></td>
            <td><?php echo $session['date'] ?></td>
            <td><?php echo $session['spots'] ?></td>
            <td><form method="post" action=""/>
                    <input type="submit" name='manage' id=login_btn value="Manage Session"/>
                    <input type="hidden" name='id' id=login_btn value="<?php echo $session['idsession'];?>"/>
                </form></td>
            <td><form method="post" action=""/>
                <input type="submit" name='delete' id=login_btn value="Delete Session"/>
                <input type="hidden" name='id' id=login_btn value="<?php echo $session['idsession'];?>"/>
                </form></td>
        <?php }?>
        </tr>
    </table>
</article>
<div id="registration">
    <form method="post">
        <input name="main_menu" type="submit" id=app_btn value="Return To Main Menu" />
    </form>
</div>
</body>
</html>
