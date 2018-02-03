<?php
//This page displays the client information of all clients that have placed a reservation of a  session selected
// in the manage session screen. The page displays each client's contact info and a column indicating the confirmation
// status of the client's reservation (via email or telephone). The page also provides the manager two options:
// delete and update; the first one removing a particular client for the selected session and update updating
// the reservation confirmation status of the client.




ob_start();
session_start();
if ( $_SESSION['logged_in'] != 1 )
{
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
}
$idsession=$_SESSION['selected_session'];

//Connect to DB
$host = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'ReservationDatabase';
$mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);


//Process a join query matching all clients that appear in the Reservation Table and whose session ID matches the one
//related for this particular session; retrieving in the process all related contact information for such clients.

$data=$mysqli->query("SELECT client.idclient, client.first_name, client.last_name, client.business_name, client.email,
 client.telephone, reservation.confirmation, reservation.idsession  FROM client,reservation WHERE client.idclient=reservation.clientid AND idsession='$idsession' ORDER BY client.idclient");
?>
<!DOCTYPE HTML>
<html>
<head>
    <title> Session </title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') //Proces actions based on which button is pressed
{
    if (isset($_POST['update'])) //If the update button is pressed
    {
        $_SESSION['idclient']=$_POST['idc']; //Initiate  a session variable that will be used to process
        //the confirmation status of a client
        require 'update_confirmation.php'; //Call this file to process the update. Consult this file for
        //further explanations of the procedure.
    }
    elseif(isset($_POST['delete'])) //If the delete button was pressed
    {
        //Create sesion variables that will be used to process the removal of the client from the session
        $_SESSION['idclient']=$_POST['id'];
        $_SESSION['sesid']=$_POST['sessionid'];
        require 'process_client_session_removal.php'; //Call this file to procees the removal. Consult this file
        //for further explanations fo the procedure.
    }
    elseif(isset($_POST['main_menu'])) //If the return to main menu button has been pressed
    {
        header("Location: http://localhost:8888/DatabaseProject/management/management_menu_db.php");
    }
    elseif(isset($_POST['manage_session'])) //If the manage Return To Manage session button has been pressed
    {
        header("Location: http://localhost:8888/DatabaseProject/management/manage_session.php");
    }
    elseif (isset($_POST['logout']))
    {
        require 'process_logout.php';
    }
}
?>
<body>
<article>
    <table align="center">
        <tr>
            <td colspan="9" id="header"><h1><?php echo "Session:".$idsession ?></h1></td>
        </tr>
        <tr>
            <th>Client ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Business Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Confirmation</th>
            <th></th>
            <th></th>
        </tr>
        <?php  while($session=mysqli_fetch_array($data)){?>
        <tr>
            <td><?php echo $session['idclient'] ?></td>
            <td><?php echo $session['first_name'] ?></td>
            <td><?php echo $session['last_name'] ?></td>
            <td><?php echo $session['business_name'] ?></td>
            <td><?php echo $session['telephone'] ?></td>
            <td><?php echo $session['email'] ?></td>
            <td><form action="http://localhost:8888/DatabaseProject/authenticate/register_db_mysqli.php" method="post">
                <input type="text" name="firstname" id="f_n" required value="<?php echo $session['confirmation']?>">
            </form></td>
            <td><form method="post"/>
                    <input type="submit" name='delete' id=login_btn value="Delete"/>
                    <input type="hidden"  name='id' value="<?php echo $session['idclient']?>" />
                    <input type="hidden"  name='sessionid' value="<?php echo $session['idsession']?>"/>
                </form></td>
            <td><form method="post"/>
                <input type="submit" name='update' id=login_btn value="Update"/>
                <input type="hidden"  name='idc' value="<?php echo $session['idclient']?>" />
                </form></td>
        <?php }?>
        </tr>
    </table>
</article>
<div id="registration">
    <form method="post">
        <input name="main_menu" type="submit" id=registration_btn value="Return To Main Menu" />
    </form>
    <form method="post">
        <input name="manage_session" type="submit" id=registration_btn value="Return To Manage Sessions" />
    </form>
</div>
</body>
</html>