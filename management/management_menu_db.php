<?php
//This is the main menu page for the management side of the application. It will display three options to the
//manager: Manage Sessions, Create a New Session and View All Session Information (Overall summary of all active sessions
//and related clients who have reserved for sessions).

ob_start(); //Initialize Bufffer
session_start();
if ( $_SESSION['logged_in'] != 1 )
{
    $_SESSION['message'] = "You must log in before viewing your profile page!";
    header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
}
//
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['manage']))
    {
        header("Location: http://localhost:8888/DatabaseProject/management/manage_session.php");
    }
    elseif (isset($_POST['create']))
    {
        header("Location: http://localhost:8888/DatabaseProject/management/create_session_db.php");
    }
    elseif (isset($_POST['all']))
    {
        header("Location: http://localhost:8888/DatabaseProject/management/view_all_session_info.php");
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
        <input name="manage" type="submit" id=registration_btn value="Manage Sessions" />
        <input name="create" type="submit" id=registration_btn value="Create A New Session" />
        <input name="all" type="submit" id=registration_btn value="View All Registrants" />
    </form>
    <form method="post">
        <input name="logout" type="submit" id=logout_btn value="Log Out" />
    </form>
</div>
</body>
</html>
