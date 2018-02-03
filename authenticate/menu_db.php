<?php
//This is the main menu for the client side of the application. It will provide two options to the user (view account
//summary and place reservation).


ob_start(); //Activates PHP buffer
session_start(); //Allows to use session variables.
if ( $_SESSION['logged_in'] != 1 )
{
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
}
else
{
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')//Process actions based on which button is pressed
{
    if(isset($_POST['summary'])) //If Account Summary button is pressed
    {
        header("Location: http://localhost:8888/DatabaseProject/authenticate/account_summary.php");
    }
    elseif (isset($_POST['reservation'])) //If Place Reservation Button is pressed.
    {
        header("Location: http://localhost:8888/DatabaseProject/authenticate/reservation.php");
    }
    elseif (isset($_POST['logout']))
    {
        require 'process_logout.php';
    }

}
?>
<body>
<div id="registration">
    <h2>Main Menu</h2>
    <form method="post">
        <input name="summary" type="submit" id=registration_btn value="Account Summary" />
        <input name="reservation" type="submit" id=registration_btn value="Place Reservation" />
    </form>
    <form method="post">
        <input name="logout" type="submit" id=logout_btn value="Log Out" />
    </form>
</div>
</body>
</html>
