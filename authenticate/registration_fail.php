<?php


ob_start(); // Initialize html buffer to process redirects

//West: This is the template/structure I was talking about in process_login.php
?>


<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://localhost:8888/DatabaseProject/includes/style.css"/>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') //Execute this process if the user has pressed the Return to Login Screen Button.
{
    if(isset($_POST['return']))
    {
        header("Location: http://localhost:8888/DatabaseProject/authenticate/login_mysqli.php");
    }
}
?>
<body>
<div id="registration">
    <h2>A user with this email already exists!</h2>

    <form method="post">
        <input name="return" type="submit" id=registration_btn value="Return To Login Screen" />
    </form>
</div>
</body>
</html>

