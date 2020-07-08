<?php
    //This page essentially displays all of the  client's information in a table (first name, last name and etc.).



    ob_start(); //Initialized an html buffer to redirect to other pages via header files.
    session_start(); //Allows to manage session variables initilized during login process
    if ( $_SESSION['logged_in'] != 1 )
    {
        $_SESSION['message'] = "You must log in before viewing your profile page!";
        header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
    }


     //Connects to the ReservationDatabase and processes two queries needed to build the Account Summary Page.
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'ReservationDatabase';
    $mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);
    //Assigns the current client's  client ID of this log in  session in order to process the query accurately
    $user=$_SESSION['id_client'];

    //Query 1: Store in $data variable all the information related to clientID  found int the client table
    $data=$mysqli->query("SELECT * FROM client WHERE idclient='$user'");

    //Query 2: Store in $info variable the reservation ID corresponding to $user
    $info=$mysqli->query("SELECT * FROM reservation where clientid=$user")


?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Account Summary</title>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php

//Processes actions based on which button is pressed on the account summary page.
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['cancel']))// If the user presses "Cancel" button
    {
        $_SESSION['iddate']=$_POST['date'];
        $_SESSION['idtime']=$_POST['time'];
        $_SESSION['idclient']=$_POST['id'];
        $_SESSION['idsession']=$_POST['session'];
        //Call this file to process the cancellation. The rest of the cancellation procedure will be processed by such file. (See Contents)
        require 'process_cancellation_reservation.php';
    }
    elseif(isset($_POST['main_menu'])) //If the user presses  "Main Menu" button
    {
        //Send to main menu of client page
        header( "Location: http://localhost:8888/DatabaseProject/authenticate/menu_db.php");
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
            <td colspan="7" id="header"><h1>Account Summary</h1></td>
        </tr>
        <?php  while($user=mysqli_fetch_array($data)){?>
            <tr>
                <th scope="row">Client ID:</th>
                <td><?php echo $user['idclient'] ?></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">First Name</th>
                <td><?php echo $user['first_name'] ?></td>
                <td><form action="http://localhost:8888/DatabaseProject/authenticate/update_client_info.php">
                        <input type="submit" id=login_btn name=update value="Update"/>
                    </form></td>
            </tr>
            <tr>
                <th scope="row">Last Name</th>
                <td><?php echo $user['last_name'] ?></td>
                <td><form action="http://localhost:8888/DatabaseProject/authenticate/update_client_info.php">
                        <input type="submit" id=login_btn  name=update value="Update"/>
                    </form></td>
            </tr>
            <tr>
                <th scope="row">Email Address:</th>
                <td><?php echo $user['email'] ?></td>
                <td><form action="http://localhost:8888/DatabaseProject/authenticate/update_client_info.php">
                        <input type="submit" id=login_btn name=update value="Update"/>
                    </form></td>
            </tr>
            <tr>
                <th scope="row">Telephone Number:</th>
                <td><?php echo $user['telephone'] ?></td>
                <td><form action="http://localhost:8888/DatabaseProject/authenticate/update_client_info.php">
                        <input type="submit" id=login_btn name= update value="Update"/>
                    </form></td>
            </tr>
        <?php }?>
        <?php while($user=mysqli_fetch_array($info)){?>
            <tr>
                <th scope="row">Reservation Info:</th>
                <td><?php echo "Date: ".$user['date']." // "."Time: ".$user['time']." // "."Reservation ID: ".$user['idreservation'];?></td>
                <td>
                <form method="post" action=""/>
                    <input type="submit" id=login_btn name='cancel' value="Cancel"/>
                    <input type="hidden" name='date' id=login_btn value="<?php echo $user['date'];?>"/>
                    <input type="hidden" name='time' id=login_btn value="<?php echo $user['time'];?>"/>
                    <input type="hidden" name='id' id=login_btn value="<?php echo $user['clientid'];?>"/>
                    <input type="hidden" name='session' id=login_btn value="<?php echo $user['idsession'];?>"/>
                </form></td>
            </tr>
        <?php }?>
    </table>
</article>
<br>
<br>
<div id="registration">
    <form method="post">
        <input name="main_menu" type="submit" id=app_btn value="Return To Main Menu" />
    </form>
</div>
</body>
</html>



