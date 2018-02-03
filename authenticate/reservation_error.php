<?php


ob_start(); // Initialize html buffer to process redirects


?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') //Execute this process if the user has pressed the Return to Reservation Screen.
{
    if(isset($_POST['return']))
    {
        header("Location: http://localhost:8888/DatabaseProject/authenticate/reservation.php");
    }
    else if(isset($_POST['summary'])) //If Account Summary button is pressed
    {
        header("Location: http://localhost:8888/DatabaseProject/authenticate/account_summary.php");
    }
    elseif(isset($_POST['main_menu'])) //If the user presses  "Main Menu" button
    {
        //Send to main menu of client page
        header( "Location: http://localhost:8888/DatabaseProject/authenticate/menu_db.php");
    }
}
?>
<body>

    <h2 align="center">You have already reserved for a session. Please cancel your current session in the Account Summary Page</h2>
    <div id="registration">
    <form method="post">
        <input name="return" type="submit" id=registration_btn value="Return To Reservation Screen" />
    </form>
    <form method="post">
        <input name="summary" type="submit" id=registration_btn value=" Go to Account Summary" />
        <input name="main_menu" type="submit" id=registration_btn value="Return to Main Menu" />
    </form>
</div>
</body>
</html>

