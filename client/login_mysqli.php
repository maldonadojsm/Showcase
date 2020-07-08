<?php
    // This is the login screen for the application. Both users and managers will use this page to access
    // their respective sections of the applications.

    //Connect to DB to proceed with user verification
    ob_start();
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'ReservationDatabase';
    $mysqli = mysqli_connect($host,$user,$pass,$db) or die($mysqli->error);
    session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['login']))
    {   //Calls on this file in order to process the parameters "username" and "password" entered by the users.
        // The rest of this procedure will be processed by such file (consult contents).
        require 'process_login.php';

    }
}
?>
<body background="/Applications/MAMP/htdocs/DatabaseProject/WebBackgroundLogin.jpg">
<div id="login">
    <form action="http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php" method="post">
        <h2>Welcome</h2>
        <input type="email" id="username" name="email" placeholder="Enter Email Address"/>
        <input type="password" id="password" name="password" placeholder="Enter Password"/>
        <input type="submit" id="login_btn" name="login" value="Sign In"/>
        Not Registered? <a href="register_db_mysqli.php">Sign Up </a>
    </form>
</div>
</body>
</html>